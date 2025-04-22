<?php

namespace App\Http\Controllers\Manager;

use App\Models\Receiver;
use App\Models\OrderPickUp;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\AssignedOrderToDriver;

class OrderPickUpController extends Controller
{
    public function getOrderPickupsByProvince(Request $request)
    {
        $province = $request->input('province');

        // Fetch receivers from the selected province
        $receivers = Receiver::where('province', $province)->pluck('id');

        // Fetch order pickups linked to these receivers
        $orderPickups = OrderPickUp::whereHas('receiver', function ($query) use ($province) {
            $query->where('province', $province);
        })
            ->whereDoesntHave('assignedOrderToDriver') // Check that there's no assigned driver
            ->with('sender') // Include sender relationship
            ->get();
        // Return JSON response
        return response()->json($orderPickups);
    }

    public function assignDriver(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'manager_id' => 'required|exists:users,id', // Ensure manager_id exists in the users table
            'driver_id' => 'required', // Ensure driver_id exists in the drivers table
            'order_pickup_ids' => 'required|array', // Ensure the order_pickup_ids are passed as an array
            'order_pickup_ids.*' => 'exists:order_pickups,id' // Validate each order_pickup_id exists in the order_pickups table
        ]);

        // Fetch the selected driver ID and manager ID from the request
        $driverId = $request->driver_id;
        $managerId = $request->manager_id;

        // Loop through the selected order pickup IDs and store them in the AssignedOrderToDriver model
        foreach ($request->order_pickup_ids as $orderPickupId) {
            // Create an entry in the AssignedOrderToDriver model
            AssignedOrderToDriver::create([
                'manager_id' => $managerId,
                'order_number' => OrderPickup::find($orderPickupId)->order_number, // Adjust based on your OrderPickup model
                'driver_id' => $driverId,
                'order_pickup_id' => $orderPickupId
            ]);
        }

        // Return a success response
        return response()->json(['message' => 'Driver assigned successfully'], 200);
    }

    public function assignDriverPackages()
    {
        $managerId = Auth::user()->id; // Assuming manager is logged in

        $assignedOrders = AssignedOrderToDriver::where('manager_id', $managerId)
            ->with(['orderPickup', 'driver'])
            ->get();
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

            
        return view('admin.pages.packages.assigned_drivers', compact('assignedOrders','provinces'));
    }
}
