<?php

namespace App\Http\Controllers\User;

use App\Models\Sender;
use App\Models\Receiver;
use App\Models\OrderPickUp;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\SenderIdentityCard;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\AssignedOrderToDriver;

class ShippingController extends Controller
{
    public function store(Request $request)
    {
        // Check if a record with the same invoice_number and order_number exists
        $orderPickUp = OrderPickUp::where('invoice_number', $request->invoice_number)
            ->where('order_number', $request->order_id)
            ->first();


        if ($orderPickUp) {
            // Record exists, so update the existing record
            $orderPickUp->sender_id = $request->sender_id;
            $orderPickUp->receiver_id = $request->receiver_id;
            $orderPickUp->driver_id = $request->driver_id;
            $orderPickUp->issue_date = $request->issue_date;
            $orderPickUp->container_number = $request->container_id;
            $orderPickUp->driver_pickup_name = $request->driver_name;

            $message = 'Step-1 data data updated successfully.';
        } else {
            // No existing record, so create a new one
            $orderPickUp = new OrderPickUp();
            $orderPickUp->invoice_number = $request->invoice_number;
            $orderPickUp->sender_id = $request->sender_id;
            $orderPickUp->receiver_id = $request->receiver_id;
            $orderPickUp->driver_id = $request->driver_id;
            $orderPickUp->issue_date = $request->issue_date;
            $orderPickUp->order_number = $request->order_id;
            $orderPickUp->container_number = $request->container_id;
            $orderPickUp->driver_pickup_name = $request->driver_name;

            $message = 'Step-1 data stored successfully.';
        }

        // Save the record (update or create)
        $orderPickUp->save();

        // Update the order_pickup_id for the latest SenderIdentityCard where sender_id matches
        SenderIdentityCard::where('sender_id', $request->sender_id)
            ->latest() // Get the latest record based on the created_at column
            ->limit(1) // Limit to only one record
            ->update(['order_pickup_id' => $orderPickUp->id]);
        return response()->json(['success' => true, 'message' => $message]);
    }
    public function add_form()
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


        // Retrieve the container number from the config
        $containerNumber = config('global.currentContainerNumber', 'EPG20');

        // Get the authenticated user's ID
        $userId = Auth::id();

        // Generate a unique 4-character alphanumeric string
        $uniqueCode = Str::upper(Str::random(4));

        // Retrieve the last order's incremental part from the database
        $lastOrder = OrderPickUp::orderBy('id', 'desc')->first();
        $incrementalNumber = $lastOrder ? (int) substr($lastOrder->order_number, -4) + 1 : 1;

        // Format the incremental part to be 4 digits (e.g., 0001)
        $incrementalNumber = str_pad($incrementalNumber, 4, '0', STR_PAD_LEFT);

        // Combine all parts
        $orderNumber = "{$containerNumber}-{$userId}-{$uniqueCode}-{$incrementalNumber}";

        return view('user.pages.shipping.add_form', compact('provinces','orderNumber'));
    }
    public function searchCustomers(Request $request)
    {
        $query = $request->get('query');

        $customers = Sender::where('first_name', 'LIKE', "%{$query}%")
            ->orWhere('last_name', 'LIKE', "%{$query}%")
            ->orWhere('email', 'LIKE', "%{$query}%")
            ->orWhere('telephone', 'LIKE', "%{$query}%")
            ->orWhere('cell', 'LIKE', "%{$query}%")
            ->get(['id', 'first_name', 'last_name', 'email', 'street_address', 'apt', 'city', 'state', 'zip', 'telephone', 'cell']);

        return response()->json($customers);
    }

    public function fetchRepeatReceivers(Request $request)
    {
        $senderId = $request->input('sender_id');

        $repeatReceivers = Receiver::where('sender_id', $senderId)
            ->get([
                'id',
                'first_name',
                'last_name',
                'email',
                'telephone',
                'cell',
                'address',
                'neighborhood',
                'city',
                'province',
                'reference'
            ]);
        return response()->json($repeatReceivers);
    }


    public function fetchReceiverDetails(Request $request)
    {
        $receiverId = $request->query('id'); // Get the receiver ID from the query parameters

        // Fetch receiver details from the database
        $receiver = Receiver::find($receiverId);

        if ($receiver) {
            return response()->json($receiver);
        } else {
            return response()->json(['error' => 'Receiver not found'], 404);
        }
    }
    public function invoice_list()
    {
        $driverId = Auth::id(); // Assuming the driver is logged in
       $invoices = OrderPickUp::where('order_number','!=',null)->get();

       return view('user.pages.shipping.invoice_list', compact('invoices'));
    }
    public function us_invoice_list()
    {
        $driverId = Auth::id(); // Assuming the driver is logged in
       $invoices = OrderPickUp::where('order_number','!=',null)->where('driver_id' , $driverId)->get();

       return view('user.pages.shipping.invoice_list', compact('invoices'));
    }
    public function rd_invoice_list()
    {
        // Fetch orders assigned to the logged-in driver
        $driverId = Auth::id(); // Assuming the driver is logged in
        $orders = AssignedOrderToDriver::with(['orderPickup.receiver'])
            ->where('driver_id', $driverId)
            ->get();


       return view('driver.pages.invoice_list', compact('orders'));
    }

}
