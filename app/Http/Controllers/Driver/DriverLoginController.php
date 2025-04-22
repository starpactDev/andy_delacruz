<?php

namespace App\Http\Controllers\Driver;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DriverLoginController extends Controller
{
    public function driver_login()
    {

        return view('admin.pages.auth.login');
    }
    public function driver_login_check(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials) && Auth::user()->type == 1) {

            return redirect()->intended(route('driver.dashboard'))
                ->with('success', 'You have successfully signed in');
        }
        // If the user is not found, try logging in as a sender
        if (Auth::guard('sender')->attempt($credentials)) {
            return redirect()->intended(route('customer.dashboard'))
                ->with('success', 'You have successfully signed in as a customer');
        }
        return redirect()->route('driver_login')->with('error', 'Login details are not valid');
    }
    public function driver_logout()
    {

        Auth::logout();
        return redirect()->route('driver_login')->with('success', 'You have been successfully logged out!');
    }
}
