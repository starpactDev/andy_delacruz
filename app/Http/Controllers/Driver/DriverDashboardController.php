<?php

namespace App\Http\Controllers\Driver;

use App\Models\CreateEvent;
use App\Models\OrderPickUp;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\AssignedOrderToDriver;

class DriverDashboardController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();

        $team = $user->driverInfo->team;
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

        // Fetch orders assigned to the logged-in driver
        $driverId = Auth::id(); // Assuming the driver is logged in
        $orders = AssignedOrderToDriver::with(['orderPickup.receiver'])
            ->where('driver_id', $driverId)
            ->get();

        // For Usa Dashboard
        $orderPickups = OrderPickUp::where('driver_id', $driverId)->get();

// For RD Driver Dashboard
        $isCompletedZeroCount = $orders->filter(function ($order) {
            return $order->orderPickup && $order->orderPickup->is_completed == 0;
        })->count();

        $isCompletedOneCount = $orders->filter(function ($order) {
            return $order->orderPickup && $order->orderPickup->is_completed == 1;
        })->count();

        // Count the pending orders (where is_completed is 0)
        $pendingOrdersCount = CreateEvent::countPickupOrders($driverId);
        // Group orders by province
        $groupedOrders = $orders->groupBy(function ($order) {
            return $order->orderPickup->receiver->province ?? 'Unknown';
        });
        return view('admin.pages.dashboard', compact('team', 'provinces', 'groupedOrders', 'orders', 'orderPickups', 'pendingOrdersCount','isCompletedZeroCount','isCompletedOneCount'));
    }
}
