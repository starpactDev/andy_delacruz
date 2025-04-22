<?php

namespace App\Http\Controllers\Admin\Due;

use App\Models\OrderPickUp;
use PayPal\Rest\ApiContext;
use App\Models\OrderPayment;
use App\Models\PaymentModel;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\{Payer, Item, ItemList, Amount, Transaction, RedirectUrls, Payment, PaymentExecution};

class PaymentController extends Controller
{
    public function getPaymentDetails($id)
    {
        $orderPickup = OrderPickUp::with('payments')->findOrFail($id); // Assuming payments relationship exists
        $deposits = $orderPickup->payments->map(function ($payment) {
            return [
                'amount' => $payment->deposit, // Assuming 'deposit' represents the payment amount
                'method' => $payment->payment_method,
            ];
        });
        $response = [
            'total_amount' => $orderPickup->grand_total_amount,
            'deposits' => $deposits->toArray(),
            'amount_due' => $orderPickup->grand_total_amount - $orderPickup->payments->sum('deposit'),
            'payment_method' => $orderPickup->payments->last()->payment_method ?? 'N/A',
            'payment_status' => $orderPickup->grand_total_amount == $orderPickup->payments->sum('deposit') ? 'Paid' : 'Pending',
            'is_paid' => $orderPickup->grand_total_amount == $orderPickup->payments->sum('deposit'),
            'order_pickup_id' => $orderPickup->id
        ];

        return response()->json($response);
    }
    private $apiContext;

    public function __construct()
    {

        Log::info('PayPal Client ID: ' . env('PAYPAL_CLIENT_ID'));
        Log::info('PayPal Secret: ' . env('PAYPAL_SECRET'));
        Log::info('PayPal Mode: ' . env('PAYPAL_MODE'));
        // Instantiate ApiContext with credentials and settings
        $this->apiContext = new ApiContext(
            new OAuthTokenCredential(
                config('services.paypal.client_id'), // PayPal client ID
                config('services.paypal.secret')    // PayPal secret
            )
        );

        // Set additional configuration options
        $this->apiContext->setConfig(config('services.paypal.settings'));
    }

    public function createPayment(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0',
            'order_pickup_id' => 'required|exists:order_pickups,id',
            'payment_method' => 'required|string'
        ]);

        $orderPickUp = OrderPickUp::findOrFail($request->order_pickup_id);
        $accountType = $request->account_type ?? 'admin';
        if ($request->payment_method === 'cash') {
            // Handle cash payment
            $orderPayment = OrderPayment::create([
                'order_pickup_id' => $orderPickUp->id,
                'deposit' => $request->amount,
                'payment_method' => 'cash',
            ]);

            $orderPickUp->amount_paid += $request->amount;
            $orderPickUp->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Cash payment recorded successfully.'
            ]);
        }

        else if ($request->payment_method === 'peso') {
             // Handle cash payment
             $orderPayment = OrderPayment::create([
                'order_pickup_id' => $orderPickUp->id,
                'deposit' => $request->amount,
                'payment_method' => 'Exchange in Peso',
                'exchange_confirmation_number' => $request->exchange_confirmation_number,
            ]);

            $orderPickUp->amount_paid += $request->amount;
            $orderPickUp->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Exchange in Peso payment recorded successfully.'
            ]);

        }

        else if ($request->payment_method === 'paypal') {
            // Handle PayPal payment
            $payer = new Payer();
            $payer->setPaymentMethod('paypal');

            $item = new Item();
            $item->setName('Payment')
                ->setCurrency('USD')
                ->setQuantity(1)
                ->setPrice($request->amount);

            $itemList = new ItemList();
            $itemList->setItems([$item]);

            $amount = new Amount();
            $amount->setCurrency('USD')->setTotal($request->amount);

            $transaction = new Transaction();
            $transaction->setAmount($amount)
                ->setItemList($itemList)
                ->setDescription('Payment for Order #' . $orderPickUp->order_number);

            $redirectUrls = new RedirectUrls();
            $redirectUrls->setReturnUrl(route('paypal.success', ['order_number' => $orderPickUp->order_number,'amount' =>$request->amount ,'account_type' => $accountType]))
                ->setCancelUrl(route('paypal.cancel', ['order_number' => $orderPickUp->order_number , 'amount' =>$request->amount]));

            $payment = new Payment();
            $payment->setIntent('sale')
                ->setPayer($payer)
                ->setRedirectUrls($redirectUrls)
                ->setTransactions([$transaction]);

            try {
                $payment->create($this->apiContext);
                return response()->json([
                    'approval_url' => $payment->getApprovalLink()
                ]);
            } catch (\Exception $ex) {
                return response()->json([
                    'error' => 'Something went wrong: ' . $ex->getMessage()
                ], 500);
            }
        }

        return response()->json(['error' => 'Invalid payment method.'], 400);
    }


    public function successPayment(Request $request)
    {

        $orderNumber = $request->get('order_number');
        $orderPickUp = OrderPickUp::where('order_number', $orderNumber)->firstOrFail();

        $amount = $request->get('amount'); // Retrieve amount from PayPal response
        $transactionId = $request->get('tx'); // Transaction ID from PayPal response
        $accountType = $request->get('account_type');
        $orderPayment = OrderPayment::create([
            'order_pickup_id' => $orderPickUp->id,
            'deposit' => $amount,
            'payment_method' => 'paypal',
        ]);

        PaymentModel::create([
            'payment_method' => 'paypal',
            'order_payment_id' => $orderPayment->id,
            'transaction_id' => $transactionId,
            'amount' => $amount,
            'payment_status' => 'completed',
        ]);

        $orderPickUp->amount_paid += $amount;
        $orderPickUp->save();
        if ($accountType === 'customer') {
            return redirect()->route('order_overview_from_customer', ['order_pickup_id' => $orderPickUp->id])
                ->with('success', 'PayPal payment completed successfully.');
        }
        return redirect()->route('order_overview', ['order_pickup_id' => $orderPickUp->id])
            ->with('success', 'PayPal payment completed successfully.');

    }

    public function cancelPayment(Request $request)
    {
        return ('cancelled');
    }
}
