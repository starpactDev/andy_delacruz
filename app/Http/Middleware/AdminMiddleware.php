<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\OrderPickUp;
use App\Models\OrderPayment;
use Illuminate\Http\Request;
use App\Models\ContainerNumber;
use App\Models\ReceiverSignature;
use App\Models\ReceiverIdentityCard;
use Illuminate\Support\Facades\Auth;
use App\Models\ReceiverPackagesImage;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (isset(Auth::user()->id)) {
            $user_type = Auth::user()->type;


            $currentNumber = ContainerNumber::where('key', 'currentContainerNumber')->value('value');

            // Set the value in the config
            config(['global.currentContainerNumber' => $currentNumber]);



            // Check and update `is_completed` status for OrderPickup
            OrderPickUp::all()->each(function ($orderPickup) {
                if ($orderPickup->grand_total_amount == $orderPickup->amount_paid) {
                    $orderPickup->update(['is_completed' => 1]);
                } else {
                    $orderPickup->update(['is_completed' => 0]);
                }
            });


            OrderPickUp::all()->each(function ($orderPickup) {
                $orderPickupId = $orderPickup->order_number; // Ensure this is the correct field

                // Check existence in related tables
                $receiverIdentityExists = ReceiverIdentityCard::where('order_pickup_id', $orderPickupId)->exists();
                $receiverPackagesExists = ReceiverPackagesImage::where('order_pickup_id', $orderPickupId)->exists();
                $receiverSignatureExists = ReceiverSignature::where('order_pickup_id', $orderPickupId)->exists();

                // Update package status and set delivered_date if not already delivered
                if ($receiverIdentityExists && $receiverPackagesExists && $receiverSignatureExists) {
                    if ($orderPickup->package_status !== 'DELIVERED') { // Ensure it's set only once
                        $orderPickup->update([
                            'package_status' => 'DELIVERED',

                            'updated_at' => now(),
                        ]);
                    }
                }
            });

            if ($user_type == 1) {

                return $next($request);
                //return redirect(route('admin::dashboard'));
            } else {
                return redirect(url('/login'));
            }
        } else {
            return redirect(url('/login'));
        }
    }
}
