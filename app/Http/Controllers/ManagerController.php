<?php

namespace App\Http\Controllers;

use App\Models\Receiver;
use App\Models\OrderPickUp;
use Illuminate\Http\Request;
use App\Models\UserDriverInfo;
use App\Models\AddNotesByRdDriver;
use Illuminate\Support\Facades\DB;
use App\Models\AssignedOrderToDriver;

class ManagerController extends Controller
{


    public function distribution_of_packagers(Request $request)
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

        $currentContainerNumber = config('global.currentContainerNumber');
        $orderPickups = OrderPickUp::where('container_number', $currentContainerNumber)->get();
        $notesCount = AddNotesByRdDriver::whereIn('order_pickup_id', $orderPickups->pluck('id'))->count();
        $groupedOrders = $orderPickups->groupBy(function ($order) {
            return $order->receiver->province ?? 'Unknown'; // Fallback to 'Unknown' if province is null
        });
        $dominicanTeamDrivers = UserDriverInfo::where('team', 'Dominican Team')->get();

        // Here we will pass the token to the reset form
        return view('user.manager.route.distribution',compact('notesCount','groupedOrders','provinces','dominicanTeamDrivers'));
    }
    public function assignOrders(Request $request)
    {

        $orderNumbers = $request->input('orders');
        $driverID = $request->input('driverID');


        // Logic to assign orders to the driver
        foreach ($orderNumbers as $orderNumber) {
            // Find the order by its number
            $order = OrderPickUp::where('order_number', $orderNumber)->first();

            if ($order) {
                // Retrieve the order_pickup_id from the found order
                $orderPickupID = $order->id;  // Assuming 'id' is the primary key of the 'order_pickups' table

                // Create a new AssignedOrderToDriver instance
                AssignedOrderToDriver::create([
                    'order_number' => $orderNumber,
                    'driver_id' => $driverID,
                    'order_pickup_id' => $orderPickupID,
                    'manager_id' => auth()->user()->id,  // Assuming the manager is logged in
                ]);
            }
        }
        // Return a success response
        return response()->json(['success' => true]);
    }
    public function getCitiesByProvince(Request $request)
{
    $province = $request->province;

    // Ensure province is provided before querying
    if (!$province) {
        return response()->json([], 400); // Return an empty array or handle error as needed
    }

    // Fetch unique cities for the selected province
    $cities = Receiver::where('province', $province)->distinct()->pluck('city');

    return response()->json($cities);
}
}
