<?php

namespace App\Http\Controllers\Driver;

use Milon\Barcode\DNS1D;
use Illuminate\Http\Request;
use App\Models\BarcodeShipping;
use App\Http\Controllers\Controller;

class BarcodeShippingController extends Controller
{
    public function generateBarcodeAndRedirect($orderNumber)
    {
        $barcodeImageName = 'barcode_' . $orderNumber . '.png';
        $barcodePath = public_path('barcodes/' . $barcodeImageName);

        // Check if the barcode image already exists
        if (!file_exists($barcodePath)) {
            // Create the 'barcodes' directory if it doesn't exist
            if (!file_exists(public_path('barcodes'))) {
                mkdir(public_path('barcodes'), 0777, true);
            }

            // Generate the barcode image
            $barcodeGenerator = new DNS1D();
            $barcodeImage = $barcodeGenerator->getBarcodePNG($orderNumber, 'C128', 2, 50);

            // Save the barcode image
            file_put_contents($barcodePath, base64_decode($barcodeImage));

            // Store barcode details in the database
            BarcodeShipping::create([
                'order_number' => $orderNumber,
                'barcode_image' => $barcodeImageName,
            ]);
        }

        // Redirect to the invoice preview page
        return redirect()->route('driver.invoice.shipping.preview', ['order_number' => $orderNumber]);
    }


}
