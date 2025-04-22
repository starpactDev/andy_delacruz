<?php

namespace App\Http\Controllers;

use App\Models\OrderPickUp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\AssignedOrderToDriver;

class RDDriverMoneyExchangeController extends Controller
{
   public function index()
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


        return view('driver.pages.rddriver.money_exchange_peso',compact('dueOrders'));

   }
}
