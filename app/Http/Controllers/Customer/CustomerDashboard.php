<?php

namespace App\Http\Controllers\Customer;


use App\Models\Sender;
use App\Models\OrderPickUp;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CustomerDashboard extends Controller
{
    


    public function updateSender(Request $request)
    {
        $sender = auth()->guard('sender')->user();  // Get the logged-in sender using the sender guard

        if (!$sender) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $sender->update([
            'first_name' => explode(' ', $request->full_name)[0],
            'last_name' => explode(' ', $request->full_name)[1] ?? '',
            'email' => $request->email,
            'telephone' => $request->telephone,
            'street_address' => $request->street_address,
            'city' => $request->city,
            'apt' => $request->apt,
            'state' => $request->state,
            'zip' => $request->zip,
        ]);

        return response()->json(['message' => 'Details updated successfully!']);
    }



    public function dashboard()
    {
        $id = auth('sender')->id();

        $orders = OrderPickUp::where('sender_id', $id)->get();
        $sender = auth('sender')->user();

        return view('CustomerDashboard.dashboard',compact('orders','sender'));
    }
    public function new_package_request_form()
    {



        return view('CustomerDashboard.new_package_request_form');
    }

    public function logout()
    {
        Auth::guard('sender')->logout();
        return redirect()->route('driver_login');
    }
}
