<?php

namespace App\Http\Controllers\User;

use App\Models\OrderPickUp;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    public function add_form()
    {
        return view('user.pages.invoice.add_form');
    }

    public function fetchInvoicesPrint()
    {
        // Retrieve the 'orders' data from the session
        $orders = session('orders'); // This fetches the orders from the session

        // Check if orders exist in the session
        if (!$orders) {
            return redirect()->route('driver.dashboard')->with('error', 'Something went wrong. Please try again.');
        }

        // Display the invoice page with the 'orders' data
        return view('user.pages.invoice.index', compact('orders'));
    }
    public function fetchStartInvoicesPrint()
    {
        // Retrieve the 'orders' data from the session
        $orders = session('orders'); // This fetches the orders from the session

        // Check if orders exist in the session
        if (!$orders) {
            return redirect()->route('driver.dashboard')->with('error', 'Something went wrong. Please try again.');
        }

        // Display the invoice page with the 'orders' data
        return view('user.pages.invoice.all_first_page', compact('orders'));
    }
    /*************  ✨ Codeium Command 🌟  *************/
    public function index($order_number)
    {
        // Retrieve the OrderPickUp record from the database using the given order_number
        // The record is fetched using an eager load with the sender, receiver, itemDescriptions and signatureSender relationships.
        // This is done to reduce the number of queries to the database and to pre-load the related data.
        // Fetch the first matching OrderPickUp record using the order_number
        $orderDetails = OrderPickUp::with(['sender', 'receiver', 'itemDescriptions', 'signatureSender'])
            ->where('order_number', $order_number)
            ->first();
        $deposits = $orderDetails->payments->map(function ($payment) {
            return [
                'amount' => $payment->deposit, // Assuming 'deposit' represents the payment amount
                'method' => $payment->payment_method,
            ];
        });

        // If the orderDetails record is found, create an array of deposits made on the order
        // Each deposit is represented by an associative array with the keys 'amount' and 'method'
        // The 'amount' key contains the amount of the deposit and the 'method' key contains the payment method used
        $deposits = $orderDetails ? $orderDetails->payments->map(function ($payment) {
            return [
                'amount' => $payment->deposit, // Assuming 'deposit' represents the payment amount
                'method' => $payment->payment_method,
            ];
        }) : [];
        // Access the signature image
        $signatureImagePath = null;
        if ($orderDetails && $orderDetails->signatureSender) {
            $signatureImagePath = asset('sender_signatures/' . $orderDetails->signatureSender->signature_image);
        }
        $receiversignatureImagePath = null;
        if ($orderDetails && $orderDetails->signatureReceiver) {
            $receiversignatureImagePath = asset('sender_signatures/' . $orderDetails->signatureReceiver->signature_image);
        }

        // Access the signature image if it exists
        return view('user.pages.invoice.invoice_preview', compact('orderDetails', 'signatureImagePath', 'deposits', 'receiversignatureImagePath'));
    }
    public function share_index($order_number)
    {
        // Retrieve the OrderPickUp record from the database using the given order_number
        // The record is fetched using an eager load with the sender, receiver, itemDescriptions and signatureSender relationships.
        // This is done to reduce the number of queries to the database and to pre-load the related data.
        // Fetch the first matching OrderPickUp record using the order_number
        $orderDetails = OrderPickUp::with(['sender', 'receiver', 'itemDescriptions', 'signatureSender'])
            ->where('order_number', $order_number)
            ->first();


        // If the orderDetails record is found, create an array of deposits made on the order
        // Each deposit is represented by an associative array with the keys 'amount' and 'method'
        // The 'amount' key contains the amount of the deposit and the 'method' key contains the payment method used
        $deposits = $orderDetails ? $orderDetails->payments->map(function ($payment) {
            return [
                'amount' => $payment->deposit, // Assuming 'deposit' represents the payment amount
                'method' => $payment->payment_method,
            ];
        }) : [];
        // Access the signature image
        $signatureImagePath = null;
        if ($orderDetails && $orderDetails->signatureSender) {
            $signatureImagePath = asset('sender_signatures/' . $orderDetails->signatureSender->signature_image);
        }
        $receiversignatureImagePath = null;
        if ($orderDetails && $orderDetails->signatureReceiver) {
            $receiversignatureImagePath = asset('sender_signatures/' . $orderDetails->signatureReceiver->signature_image);
        }

        // Access the signature image if it exists
        return view('user.pages.invoice.invoice_share', compact('orderDetails', 'signatureImagePath', 'deposits', 'receiversignatureImagePath'));
    }
    public function invoice_pdf($order_number)
    {
        // Fetch the order details
        $orderDetails = OrderPickUp::with(['sender', 'receiver', 'itemDescriptions', 'signatureSender', 'payments'])
            ->where('order_number', $order_number)
            ->first();

        // Handle deposits from payments
        $deposits = $orderDetails ? $orderDetails->payments->map(function ($payment) {
            return [
                'amount' => $payment->deposit, // Assuming 'deposit' represents the payment amount
                'method' => $payment->payment_method,
            ];
        }) : [];

        $imagePath = public_path('admin/assets/images/andy.png');
        $imageData = base64_encode(file_get_contents($imagePath));
        $imageSrc = 'data:image/png;base64,' . $imageData;
        //return view('user.pages.invoice.invoice_pdf', compact('orderDetails', 'deposits'));

        // Generate the PDF
         $pdf = Pdf::loadView('user.pages.invoice.invoice_pdf', compact('orderDetails', 'deposits','imageSrc'));
         $pdf->setPaper('A4', 'portrait');
        // Return the PDF as a stream for viewing in the browser
        return $pdf->stream('invoice.pdf');

        // Alternatively, to download the PDF:
        // return $pdf->download('invoice.pdf');
    }
    /******  db64d22e-6a61-4c7b-8e26-d8d7f841c18e  *******/
    public function edit_form($order_number)
    {
        $provinces = [
            ['name' => 'AZUA'],
            ['name' => 'BAHORUCO'],
            ['name' => 'BARAHONA'],
            ['name' => 'DAJABON'],
            ['name' => 'DISTRITO NACIONAL'],
            ['name' => 'DUARTE'],
            ['name' => 'EL SEYBO'],
            ['name' => 'ELIAS PIÑA'],
            ['name' => 'ESPAILLAT'],
            ['name' => 'HATO MAYOR'],
            ['name' => 'HERMANAS MIRABAL'],
            ['name' => 'INDEPENDENCIA'],
            ['name' => 'LA ALTAGRACIA'],
            ['name' => 'LA ROMANA'],
            ['name' => 'LA VEGA'],
            ['name' => 'MARIA TRINIDAD SANCHEZ'],
            ['name' => 'MONSEÑOR NOUEL'],
            ['name' => 'MONTE PLATA'],
            ['name' => 'MONTECRISTI'],
            ['name' => 'PEDERNALES'],
            ['name' => 'PERAVIA'],
            ['name' => 'PUERTO PLATA'],
            ['name' => 'SAMANA'],
            ['name' => 'SAN CRISTOBAL'],
            ['name' => 'SAN JOSE DE OCOA'],
            ['name' => 'SAN JUAN'],
            ['name' => 'SAN PEDRO DE MACORIS'],
            ['name' => 'SANCHEZ RAMIREZ'],
            ['name' => 'SANTIAGO'],
            ['name' => 'SANTIAGO RODRIGUEZ'],
            ['name' => 'SANTO DOMINGO'],
            ['name' => 'VALVERDE'],
        ];
        // Fetch the first matching OrderPickUp record using the order_number
        $orderDetails = OrderPickUp::with(['sender', 'receiver', 'itemDescriptions', 'signatureSender'])
            ->where('order_number', $order_number)
            ->first();

        // Access the signature image
        $signatureImagePath = null;
        if ($orderDetails && $orderDetails->signatureSender) {
            $signatureImagePath = asset('sender_signatures/' . $orderDetails->signatureSender->signature_image);
        }

        return view('user.pages.invoice.invoice_edit', compact('provinces', 'orderDetails', 'signatureImagePath'));
    }
    public function invoice_index($order_number)
    {
        // Fetch the first matching OrderPickUp record using the order_number
        $orderDetails = OrderPickUp::with(['sender', 'receiver', 'itemDescriptions', 'signatureSender'])
            ->where('order_number', $order_number)
            ->first();
        $deposits = $orderDetails->payments->map(function ($payment) {
            return [
                'amount' => $payment->deposit, // Assuming 'deposit' represents the payment amount
                'method' => $payment->payment_method,
            ];
        });
        // Access the signature image
        $signatureImagePath = null;
        if ($orderDetails && $orderDetails->signatureSender) {
            $signatureImagePath = asset('sender_signatures/' . $orderDetails->signatureSender->signature_image);
        }
        $receiversignatureImagePath = null;
        if ($orderDetails && $orderDetails->signatureReceiver) {
            $receiversignatureImagePath = asset('sender_signatures/' . $orderDetails->signatureReceiver->signature_image);
        }

        return view('user.pages.invoice.invoice_preview_final', compact('orderDetails', 'signatureImagePath', 'receiversignatureImagePath', 'deposits'));
    }
    public function preview($order_number)
    {
        $orderDetails = OrderPickUp::with(['sender', 'receiver', 'itemDescriptions', 'signatureSender'])
            ->where('order_number', $order_number)
            ->first();
        $deposits = $orderDetails->payments->map(function ($payment) {
            return [
                'amount' => $payment->deposit, // Assuming 'deposit' represents the payment amount
                'method' => $payment->payment_method,
            ];
        });


        // Access the signature image
        $signatureImagePath = null;
        if ($orderDetails && $orderDetails->signatureSender) {
            $signatureImagePath = asset('sender_signatures/' . $orderDetails->signatureSender->signature_image);
        }

        $receiversignatureImagePath = null;
        if ($orderDetails && $orderDetails->signatureReceiver) {
            $receiversignatureImagePath = asset('sender_signatures/' . $orderDetails->signatureReceiver->signature_image);
        }
        return view('user.pages.invoice.final_invoice', compact('orderDetails', 'signatureImagePath', 'receiversignatureImagePath', 'deposits'));
    }
    public function shipping($order_number)
    {
        $orderDetails = OrderPickUp::with(['sender', 'receiver', 'itemDescriptions', 'signatureSender'])
            ->where('order_number', $order_number)
            ->first();
        return view('user.pages.invoice.shipping_label', compact('orderDetails'));
    }
    public function collect($order_number)
    {
        $orderDetails = OrderPickUp::with(['sender', 'receiver', 'itemDescriptions', 'payments'])
            ->where('id', $order_number)
            ->first();
        return view('admin.pages.dom_driver.collect_payment', compact('orderDetails'));
    }

    public function fetchInvoices(Request $request)
    {

        $orderNumbers = $request->orderNumbers;

        // Fetch orders based on the given order numbers
        $orders = OrderPickUp::whereIn('order_number', $orderNumbers)->get();
        session(['orders' => $orders]);


        return response()->json([
            'success' => true,
            'redirectUrl' => route('fetch.invoices.print')
        ]);
    }
}

