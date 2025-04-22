<?php
// app/Services/PayPalService.php

namespace App\Services;

use PayPal\Api\Item;
use PayPal\Api\Payer;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Payment;
use PayPal\Api\ItemList;
use PayPal\Api\Transaction;
use PayPal\Rest\ApiContext;
use PayPal\Api\RedirectUrls;
use PayPal\Api\PaymentExecution;
use Illuminate\Support\Facades\Log;
use PayPal\Auth\OAuthTokenCredential;

class PayPalService
{
    protected $apiContext;

    public function __construct()
    {
        $this->apiContext = new ApiContext(
            new OAuthTokenCredential(
                env('PAYPAL_CLIENT_ID'),
                env('PAYPAL_SECRET')
            )
        );
        $this->apiContext->setConfig([
            'mode' => env('PAYPAL_MODE', 'sandbox')
        ]);
    }

    // Create PayPal payment
    public function createPayment($amount, $orderPaymentId)
    {
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $amountDetails = new Amount();
        $amountDetails->setCurrency('USD')
            ->setTotal($amount);

        $transaction = new Transaction();
        $transaction->setAmount($amountDetails)
            ->setDescription('Payment for Order #' . $orderPaymentId);

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl(route('paypal.success'))
            ->setCancelUrl(route('paypal.cancel'));

        $payment = new Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setTransactions([$transaction])
            ->setRedirectUrls($redirectUrls);

        try {

            $payment->create($this->apiContext);
            // Extract the approval URL from the payment response
            foreach ($payment->getLinks() as $link) {
                if ($link->getRel() === 'approval_url') {
                    return [
                        'status' => 'redirect',
                        'approval_url' => $link->getHref(),
                    ];
                }
            }

            return [
                'status' => 'error',
                'message' => 'Approval URL not found.',
            ];
           
        } catch (\Exception $ex) {
            Log::error("General Exception: " . $ex->getMessage());
            // Handle error, log or return failure message
            return null;
        }
    }

    // Execute PayPal payment
    public function executePayment($paymentId, $payerId)
    {
        $payment = Payment::get($paymentId, $this->apiContext);
        $execution = new PaymentExecution();
        $execution->setPayerId($payerId);

        try {
            $result = $payment->execute($execution, $this->apiContext);
            return $result;
        } catch (\Exception $ex) {
            // Handle error
            return null;
        }
    }
}
