<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\OrderPickUp;
use Illuminate\Http\Request;
use App\Models\UserDriverInfo;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserDashboardController extends Controller
{
    public function dashboard()
    {
        // Fetch the province with the highest number of order pickups
        $provinceWithHighestPickups = OrderPickUp::select('receivers.province', DB::raw('count(*) as order_count'))
        ->join('receivers', 'order_pickups.receiver_id', '=', 'receivers.id') // Join with the receivers table
        ->leftJoin('assigned_order_to_drivers', 'order_pickups.id', '=', 'assigned_order_to_drivers.order_pickup_id') // Left join with AssignedOrderToDriver
        ->whereNull('assigned_order_to_drivers.order_pickup_id') // Exclude already assigned orders
        ->groupBy('receivers.province')
        ->orderByDesc('order_count') // Sort by the count of order pickups in descending order
        ->first();

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
        $dominicanTeamDrivers = UserDriverInfo::where('team', 'Dominican Team')->get();

// For Admin Dashboard
$orderPickups = OrderPickUp::latest()->take(10)->get();
$total_amount = OrderPickUp::latest()->get();
$totalAmountPaid = $total_amount->sum('grand_total_amount');

// For Manager Dashboard
$countDueOrders = OrderPickUp::where('package_status', '!=','DELIVERED')->count();
$countDeliveredOrders = OrderPickUp::where('package_status', 'DELIVERED')->count();

        return view('user.pages.dashboard', compact('provinces','provinceWithHighestPickups','dominicanTeamDrivers','orderPickups','countDueOrders','countDeliveredOrders','totalAmountPaid'));
    }
    public function manage_profile()
    {
        return view('user.pages.profile.manage');
    }
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:15',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust as needed
        ]);

        $user = User::find(Auth::id());
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');

        // Handle the profile image upload
        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('/admin/upload/images/profile'), $imageName); // Adjust the path as needed
            $user->image = $imageName; // Assuming you have a profile_image column in your users table
        }
        // dd($user);
        $user->save();

        return response()->json(['message' => 'Profile updated successfully!']);
    }

    public function updatePassword(Request $request)
    {
        // Validate the password fields
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|string|min:6',
        ]);

        $user = User::find(Auth::id());

        // Check if the old password matches the current password
        if (!Hash::check($request->old_password, $user->password)) {
            return response()->json(['errors' => ['old_password' => ['The old password is incorrect.']]], 422);
        }

        // Update the user's password
        $user->password = Hash::make($request->new_password);
        $user->save();

        return response()->json(['message' => 'Password updated successfully!']);
    }
}
