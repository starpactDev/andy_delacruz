<?php

namespace App\Http\Controllers\Admin\Customer;

use App\Models\Sender;
use App\Models\OrderPickUp;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class profileCheckCOntroller extends Controller
{
    public function checking()
    {
        return view('admin.pages.customer.email-check');
    }
    public function visit_dashboard($sender)
    {

        $orders = OrderPickUp::where('sender_id', $sender)->get();
        $sender = Sender::find($sender);
        return view('admin.pages.customer.visit_dashboard', compact('orders','sender'));
    }

    public function checkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $sender = Sender::where('email', $request->email)->first();

        if ($sender) {


            return redirect()->route('user.customer.visit_dashboard', ['sender' => $sender->id]);

        } else {
            return back()->with('error', 'Customer Email ID not found.');
        }
    }
}
