<?php

namespace App\Http\Controllers\Driver;

use App\Models\OrderPickUp;
use App\Models\OrderPayment;
use Illuminate\Http\Request;
use App\Models\ItemDescription;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use PayPal\Auth\OAuthTokenCredential;

use PayPal\Rest\ApiContext;
use Illuminate\Support\Facades\Validator;
use PayPal\Api\{Payer, Item, ItemList, Amount, Transaction, RedirectUrls, Payment, PaymentExecution};

class ShippingFinalController extends Controller
{


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
    public function storeItems(Request $request)
    {

        $request->validate([
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.itemDescription' => 'required|string|max:255',
            'items.*.itemPrice' => 'required|numeric|min:0'
        ]);

        // Delete existing items with the same order_pickup_id
        ItemDescription::where('order_pickup_id', $request->order_pickup_id)->delete();

        // Insert new items
        foreach ($request->items as $itemData) {
            ItemDescription::create([
                'order_pickup_id' => $request->order_pickup_id,
                'quantity' => $itemData['quantity'],
                'item_des' => $itemData['itemDescription'],
                'price' => $itemData['itemPrice']
            ]);
        }

        return response()->json(['success' => true]);
    }

    public function storeAll(Request $request)
    {

        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'sender_id' => 'required',
            'receiver_id' => 'required',
            'invoice_number' => 'nullable|string',
            'issue_date' => 'required|date',
            'order_number' => 'required|string',
            'container_number' => 'required|string',
            'driver_pickup_name' => 'required|string',
            'driver_id' => 'required|exists:users,id',
            'total' => 'required|numeric|min:0',
            'discount' => 'required|numeric|min:0',
            'grand_total_amount' => 'required|numeric|min:0',
            'total_no_packages' => 'required|integer|min:1',
            'payment_method' => 'nullable|string',
            'payment_location' => 'required|string',
            'signature_image_of_sender' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'label_count' => 'nullable|integer|min:1',
            'amount_paid' => 'required',
        ]);

        // Return validation errors if any
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 400);
        }

        // Proceed with storing the data if validation passes
        try {


            $checkorderPickUp = OrderPickUp::where('order_number', $request->order_number)->first();

            if($checkorderPickUp){
                return response()->json([
                    'status' => 'error',
                    'message' => 'FILL UP THE FORM AGAIN',
                ], 400);
            }

            $orderPickUp = new OrderPickUp([
                'sender_id' => $request->input('sender_id'),
                'receiver_id' => $request->input('receiver_id'),
                'invoice_number' => $request->input('invoice_number'),
                'issue_date' => $request->input('issue_date'),
                'order_number' => $request->input('order_number'),
                'container_number' => $request->input('container_number'),
                'driver_pickup_name' => $request->input('driver_pickup_name'),
                'driver_id' => $request->input('driver_id'),
                'total' => $request->input('total'),
                'discount' => $request->input('discount'),
                'grand_total_amount' => $request->input('grand_total_amount'),
                'total_no_packages' => $request->input('total_no_packages'),
                'payment_method' => $request->input('payment_method'),
                'payment_location' => $request->input('payment_location'),
                'label_count' => $request->input('label_count'),
                'amount_paid' => $request->input('amount_paid'),
            ]);

            // Return validation errors if any
            if ($validator->fails()) {
                return response()->json([
                    'status' => 'validation_error', // Use a specific error type for validation
                    'errors' => $validator->errors() // Send the validation errors
                ], 400);
            }

            // Save the order pickup record to the database
            if ($request->payment_method === 'cash') {

                $orderPickUp->save();
                OrderPayment::create([
                    'order_pickup_id' => $orderPickUp->id,
                    'deposit' => $orderPickUp->amount_paid,
                    'payment_method' => $orderPickUp->payment_method,
                ]);

                return response()->json([
                    'status' => 'success',
                    'message' => 'Order successfully stored!',
                    'order_number' => $orderPickUp->order_number
                ], 200);
            }


            // Handle PayPal Payment
            if ($request->payment_method === 'paypal') {

                $payer = new Payer();
                $payer->setPaymentMethod('paypal');

                $item = new Item();
                $item->setName('Payment')
                    ->setCurrency('USD')
                    ->setQuantity(1)
                    ->setPrice($request->amount_paid);

                $itemList = new ItemList();
                $itemList->setItems([$item]);

                $amount = new Amount();
                $amount->setCurrency('USD')
                    ->setTotal($request->amount_paid);

                $transaction = new Transaction();
                $transaction->setAmount($amount)
                    ->setItemList($itemList)
                    ->setDescription('Payment for Order #' . $orderPickUp->order_number);

                $redirectUrls = new RedirectUrls();
                $redirectUrls->setReturnUrl(route('invoice.paypal.success', [
                    'order_number' => $orderPickUp->order_number,
                    'amount' => $request->amount_paid,
                ]))
                    ->setCancelUrl(route('invoice.paypal.cancel', [
                        'order_number' => $orderPickUp->order_number,
                        'amount' => $request->amount_paid,
                    ]));

                $payment = new Payment();
                $payment->setIntent('sale')
                    ->setPayer($payer)
                    ->setRedirectUrls($redirectUrls)
                    ->setTransactions([$transaction]);

                try {
                    $orderPickUp->save();

                    $payment->create($this->apiContext);

                    return response()->json([
                        'status' => 'paypal_approval_link',
                        'approval_url' => $payment->getApprovalLink(),
                    ]);
                } catch (\Exception $ex) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Something went wrong with PayPal: ' . $ex->getMessage()
                    ], 500);
                }
            }

            if ($request->payment_method === 'venmo') {
                $orderPickUp->save();

                $gateway = new \Braintree\Gateway([
                    'environment' => env('BRAINTREE_ENV'),
                    'merchantId' => env('BRAINTREE_MERCHANT_ID'),
                    'publicKey' => env('BRAINTREE_PUBLIC_KEY'),
                    'privateKey' => env('BRAINTREE_PRIVATE_KEY'),
                ]);

                $nonce = $request->input('payment_nonce'); // Venmo payment nonce from the frontend
                if (empty($nonce)) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Payment nonce is missing. Please try again.'
                    ], 400);
                }
                $result = $gateway->transaction()->sale([
                    'amount' => $request->amount_paid,
                    'paymentMethodNonce' => $nonce,
                    'options' => [
                        'submitForSettlement' => true
                    ]
                ]);

                if ($result->success) {

                    OrderPayment::create([
                        'order_pickup_id' => $orderPickUp->id,
                        'deposit' => $request->amount_paid,
                        'payment_method' => 'venmo',
                        'transaction_id' => $result->transaction->id
                    ]);

                    return response()->json([
                        'status' => 'success',
                        'message' => 'Venmo payment successful!',
                        'order_number' => $orderPickUp->order_number,
                        'transaction_id' => $result->transaction->id
                    ], 200);
                } else {
                    $orderPickUp = OrderPickUp::where('order_number', $request->input('order_number'))->first();
                    $orderPickUp->update([

                        'amount_paid' => 0,
                        'payment_method' => 'payLater',
                    ]);
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Venmo payment failed: ' . $result->message
                    ], 400);
                }
            }
        } catch (\Exception $e) {

            $orderPickUp = OrderPickUp::where('order_number', $request->input('order_number'))->first();
            $orderPickUp->update([

                'amount_paid' => 0,
                'payment_method' => 'payLater',
            ]);

            // Handle any errors
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while processing your request.',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function successPayment(Request $request)
    {

        try {
            // Get payment details from PayPal
            $paymentId = $request->input('paymentId');
            $payerId = $request->input('PayerID');
            $orderNumber = $request->input('order_number');

            $payment = Payment::get($paymentId, $this->apiContext);

            // Execute the payment
            $execution = new PaymentExecution();
            $execution->setPayerId($payerId);

            $result = $payment->execute($execution, $this->apiContext);

            if ($result->getState() === 'approved') {
                // Payment successful, store data in the database
                $orderPickUp = OrderPickUp::where('order_number', $orderNumber)->firstOrFail();

                $orderPickUp->update([

                    'amount_paid' => $request->input('amount'),
                    'payment_method' => 'paypal',
                ]);

                // Create the associated OrderPayment record
                OrderPayment::create([
                    'order_pickup_id' => $orderPickUp->id,
                    'deposit' => $request->input('amount'),
                    'payment_method' => 'paypal',
                ]);

                // Redirect to success page or send success response
                return redirect()->route('driver.invoice.index', ['order_number' => $orderNumber])
                    ->with('success', 'Payment completed successfully!');
            } else {
                $orderPickUp = OrderPickUp::where('order_number', $orderNumber)->firstOrFail();
                $orderPickUp->update([

                    'amount_paid' => 0,
                    'payment_method' => 'payLater',
                ]);
                // Payment not approved
                return redirect()->route('driver.us_invoice.list')
                    ->with('error', 'Payment not approved by PayPal.');
            }
        } catch (\Exception $e) {
            $orderNumber = $request->input('order_number');
            $orderPickUp = OrderPickUp::where('order_number', $orderNumber)->firstOrFail();
            $orderPickUp->update([

                'amount_paid' => 0,
                'payment_method' => 'payLater',
            ]);
            return redirect()->route('driver.us_invoice.list')
                ->with('error', 'An error occurred: ' . $e->getMessage());
        }

    }

    public function cancelPayment(Request $request)
    {
        try {
            $orderNumber = $request->input('order_number');

            $orderPickUp = OrderPickUp::where('order_number', $orderNumber)->firstOrFail();
            $orderPickUp->update([

                'amount_paid' => 0,
                'payment_method' => 'payLater',
            ]);

            // Redirect to order page with cancellation message
            return redirect()->route('driver.us_invoice.list')
                ->with('error', 'Payment was canceled.');
        } catch (\Exception $e) {
            $orderNumber = $request->input('order_number');

            $orderPickUp = OrderPickUp::where('order_number', $orderNumber)->firstOrFail();
            $orderPickUp->update([

                'amount_paid' => 0,
                'payment_method' => 'payLater',
            ]);
            return redirect()->route('driver.us_invoice.list')
                ->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

}
