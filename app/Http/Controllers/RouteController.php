<?php

namespace App\Http\Controllers;

use App\Models\OrderPickUp;
use Illuminate\Http\Request;
use App\Models\AddNotesByRdDriver;

class RouteController extends Controller
{
    public function startRoute(Request $request)
    {
        $request->validate([
            'orderNumbers' => 'required|array',
            'orderNumbers.*' => 'exists:order_pickups,order_number',
        ]);

        // Fetch orders based on the given order numbers
        $orders = OrderPickUp::whereIn('order_number', $request->orderNumbers)->get();

        // Store in the session
        session(['orders' => $orders]);

        return response()->json([
            'success' => true,
            'redirectUrl' => route('fetch.start.invoices.print')
        ]);
    }

    public function fetchNotes($orderNumber)
    {
        $notes = AddNotesByRdDriver::where('order_number', $orderNumber)
            ->with('driver') // Eager load driver relationship
            ->get();

        return response()->json($notes);
    }
}
