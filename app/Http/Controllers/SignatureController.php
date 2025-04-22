<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SignatureSender;
use App\Models\ReceiverSignature;
use Illuminate\Support\Facades\Storage;

class SignatureController extends Controller
{
    public function saveSignature(Request $request)
    {
        $signatureData = $request->input('signature');

        // Remove the "data:image/png;base64," prefix and decode the base64 data
        $signatureData = str_replace('data:image/png;base64,', '', $signatureData);
        $signatureData = str_replace(' ', '+', $signatureData);
        $signatureImage = base64_decode($signatureData);

        // Define the file path and name
        $fileName = 'signature_' . time() . '.png';
        $filePath = public_path('sender_signatures/' . $fileName);

        // Save the file to the public directory
        file_put_contents($filePath, $signatureImage);

        // Create a new record in the SignatureSender model
        SignatureSender::create([
            'sender_id' => $request->input('sender_id'), // Make sure to pass sender_id in the request
            'order_id' => $request->input('order_id'), // Make sure to pass order_id in the request
            'order_pickup_id' => $request->input('order_pickup_id'), // Make sure to pass order_pickup_id in the request
            'signature_image' => $fileName, // Store the relative file path
        ]);

        return response()->json(['message' => 'Signature saved successfully', 'file' => 'sender_signatures/' . $fileName]);
    }
    public function receiver_saveSignature(Request $request)
    {

        $signatureData = $request->input('signature');

        // Remove the "data:image/png;base64," prefix and decode the base64 data
        $signatureData = str_replace('data:image/png;base64,', '', $signatureData);
        $signatureData = str_replace(' ', '+', $signatureData);
        $signatureImage = base64_decode($signatureData);

        // Define the file path and name
        $fileName = 'signature_' . time() . '.png';
        $filePath = public_path('sender_signatures/' . $fileName);

        // Save the file to the public directory
        file_put_contents($filePath, $signatureImage);

        // Create a new record in the SignatureSender model
        ReceiverSignature::create([
            'receiver_id' => $request->input('receiver_id'), // Make sure to pass sender_id in the request
            'order_id' => $request->input('order_id'), // Make sure to pass order_id in the request
            'order_pickup_id' => $request->input('order_number'), // Make sure to pass order_pickup_id in the request
            'signature_image' => $fileName, // Store the relative file path
        ]);

        return response()->json(['message' => 'Signature saved successfully', 'file' => 'sender_signatures/' . $fileName]);
    }

    public function getReceiverSignature($receiverId)
    {
        $signature = ReceiverSignature::where('order_pickup_id', $receiverId)->first();

        if ($signature) {
            return response()->json([
                'signature_image' => asset('sender_signatures/' . $signature->signature_image),
            ]);
        }

        return response()->json(['signature_image' => null], 404);
    }
}
