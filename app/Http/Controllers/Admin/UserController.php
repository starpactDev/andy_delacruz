<?php

namespace App\Http\Controllers\Admin;

use App\Models\OrderPickUp;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\AssignedOrderToDriver;

class UserController extends Controller
{

    public function index()
    {

        return view('admin.pages.user.index');
    }
    public function customer_due_amount()
    {
         // Fetch all OrderPickUp records where is_completed is 0 and driver_id matches the authenticated user's ID
    $dueOrders = OrderPickUp::where('is_completed', 0)
    ->where('driver_id', Auth::id())
    ->get();


        return view('admin.pages.dom_driver.customer_due_amount',compact('dueOrders'));
    }
    public function customer_due_amount_rd()
    {




    $driverId = Auth::id(); // Assuming the driver is logged in

    // Fetch orders assigned to the driver
    $orders = AssignedOrderToDriver::with(['orderPickup.receiver'])
        ->where('driver_id', $driverId)
        ->get();

    // Filter only those `orderPickup` where `is_completed` is 0
    $filteredOrderPickups = $orders->pluck('orderPickup')->filter(function ($orderPickup) {
        return $orderPickup && $orderPickup->is_completed == 0;
    });

    // Convert to a collection if needed
    $dueOrders = $filteredOrderPickups->values();


        return view('admin.pages.dom_driver.customer_due_amount',compact('dueOrders'));
    }
    public function transaction_history()
    {

        return view('admin.pages.dom_driver.customer_transaction_history');
    }
    public function order_overview($order_pickup_id)
    {
        $orderDetails = OrderPickUp::with(['sender', 'receiver', 'itemDescriptions','payments'])
        ->where('id', $order_pickup_id)
        ->first();
        return view('admin.pages.dom_driver.customer_order_overview',compact('orderDetails'));
    }
    public function order_overview_from_customer($order_pickup_id)
    {
        $orderDetails = OrderPickUp::with(['sender', 'receiver', 'itemDescriptions','payments'])
        ->where('id', $order_pickup_id)
        ->first();
        return view('CustomerDashboard.order_view',compact('orderDetails'));
    }

}
