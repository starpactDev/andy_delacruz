<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReceiverSignature;
use App\Models\SenderIdentityCard;
use App\Models\ReceiverIdentityCard;
use App\Models\ReceiverPackagesImage;

class ReceiverInfoController extends Controller
{
    public function uploadReciverIdImages(Request $request)
    {


        // Validate the incoming request
        $validatedData = $request->validate([
            'id_front' => 'required|image|mimes:jpeg,png,jpg',
            'id_back' => 'required|image|mimes:jpeg,png,jpg',
            'order_pickup_id' => 'required|string',
            'receiver_id' => 'required|integer',
        ], [
            'receiver_id.required' => 'Please select Receiver details first.', // Custom message for sender_id
            'id_front.required' => 'Front ID image is required.',
            'id_back.required' => 'Back ID image is required.',
        ]);

        // Create an instance of the model
        $identityCard = new ReceiverIdentityCard();

        // Handle the front ID upload
        if ($request->hasFile('id_front')) {
            $frontFile = $request->file('id_front');
            $frontFileName = time() . '_front.' . $frontFile->getClientOriginalExtension();
            $frontFile->move(public_path('uploads/identity_cards'), $frontFileName); // Change the path as needed
            $identityCard->id_front = $frontFileName;
        }

        // Handle the back ID upload
        if ($request->hasFile('id_back')) {
            $backFile = $request->file('id_back');
            $backFileName = time() . '_back.' . $backFile->getClientOriginalExtension();
            $backFile->move(public_path('uploads/identity_cards'), $backFileName); // Change the path as needed
            $identityCard->id_back = $backFileName;
        }

        // Optionally set order_pickup_id
        $identityCard->order_pickup_id = $request->order_pickup_id;
        $identityCard->receiver_id = $request->receiver_id;

        // Save the model to the database
        $identityCard->save();

        return response()->json(['message' => 'ID images uploaded successfully!']);
    }

    public function getReceiverIdImages($order_pickup_id)
    {

        // Fetch the ReceiverIdentityCard record for the given order_pickup_id
        $identityCard = ReceiverIdentityCard::where('order_pickup_id', $order_pickup_id)->first();

        if ($identityCard) {
            return response()->json([
                'id_front' => url('uploads/identity_cards/' . $identityCard->id_front),
                'id_back' => url('uploads/identity_cards/' . $identityCard->id_back),
            ]);
        }

        return response()->json(['message' => 'No ID images found for the given order_pickup_id'], 404);
    }


    public function uploadReceiverPackageImages(Request $request)
    {
        $messages = [

            'receiver_id.required' => 'Choose Sender Details First.',
            'order_pickup_id.required' => 'Order Number Missing.Refresh the Page.',

        ];
        $request->validate([
            'images.*' => 'image|mimes:jpeg,png,jpg,gif', // Adjust validation as needed
            'order_pickup_id' => 'required|string',
            'receiver_id' => 'required|integer',
        ], $messages);

        foreach ($request->file('images') as $image) {
            // Generate a unique name for the image file to avoid conflicts
            $imageName = time() . '_' . $image->getClientOriginalName();

            // Move the uploaded image to the 'public/uploads/sender_packages_images' directory
            $image->move(public_path('uploads/sender_packages_images'), $imageName);

            // Save the image path to the database
            ReceiverPackagesImage::create([
                'order_pickup_id' => $request->order_pickup_id,
                'receiver_id' => $request->receiver_id,
                'image' => 'uploads/sender_packages_images/' . $imageName, // Store the relative path in the database
            ]);
        }

        return response()->json(['success' => true, 'message' => 'Images uploaded successfully!']);
    }


    public function fetchUploadedImages(Request $request)
    {
        $request->validate([
            'order_pickup_id' => 'required|string',
        ]);

        // Get the images for the given order pickup ID
        $images = ReceiverPackagesImage::where('order_pickup_id', $request->order_pickup_id)
            ->pluck('image'); // Fetch only the image paths

        if ($images->isEmpty()) {
            return response()->json(['success' => false, 'message' => 'No images found.']);
        }

        return response()->json([
            'success' => true,
            'images' => $images, // Return the image paths
        ]);
    }

    public function checkMissingData(Request $request)
    {
        $orderPickupId = $request->order_pickup_id;

        $missingId = !ReceiverIdentityCard::where('order_pickup_id', $orderPickupId)->exists();
        $missingPackages = !ReceiverPackagesImage::where('order_pickup_id', $orderPickupId)->exists();
        $missingSignature = !ReceiverSignature::where('order_pickup_id', $orderPickupId)->exists();

        return response()->json([
            'missing_id' => $missingId,
            'missing_packages' => $missingPackages,
            'missing_signature' => $missingSignature,
        ]);
    }
}
