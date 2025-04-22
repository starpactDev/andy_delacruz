<?php

namespace App\Http\Controllers\Driver;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DriverProfileController extends Controller
{
    public function index(){
        return view('admin.pages.profile.index');
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
