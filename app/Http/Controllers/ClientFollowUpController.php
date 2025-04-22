<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\OrderPickUp;
use Illuminate\Http\Request;

class ClientFollowUpController extends Controller
{
    public function showGroupedOrders()
    {
        $threeMonthsAgo = Carbon::now()->subMonths(3);
        $sixMonthsAgo = Carbon::now()->subMonths(6);
        $twelveMonthsAgo = Carbon::now()->subMonths(12);

        $orders = OrderPickUp::
            orderBy('updated_at', 'desc')
            ->where('package_status', 'DELIVERED')
            ->get()
            ->groupBy(function ($order) use ($threeMonthsAgo, $sixMonthsAgo, $twelveMonthsAgo) {
                if ($order->updated_at >= $threeMonthsAgo) {
                    return 'Last 3 Months';
                } elseif ($order->updated_at >= $sixMonthsAgo) {
                    return 'Last 6 Months';
                } elseif ($order->updated_at >= $twelveMonthsAgo) {
                    return 'Last 12 Months';
                } else {
                    return 'Older';
                }
            });

        return view('user.pages.follow_client_orders.grouped', compact('orders'));
    }

}
