<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RouteDirectionController extends Controller
{
    public function rd_route_list(Request $request)
    {
        $province = $request->input('province');

        $orders = json_decode($request->input('orders'), true); // Decode the orders JSON string

        return view('admin.pages.driver.rddriver.route_direction_list', compact('province', 'orders'));
    }
}
