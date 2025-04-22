<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserLoginController extends Controller
{
    public function user_login()
    {

        return view('user.pages.auth.login');
    }
    public function user_login_check(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {

            if (Auth::user()->type == 0 || Auth::user()->type == 2 || Auth::user()->type == 3) {

                return redirect()->intended(route('user.dashboard'))
                    ->with('success', 'You have successfully signed in');
            }
        }

        return redirect()->route('user_login')->with('error', 'Login details are not valid');
    }
    public function user_logout()
    {

        Auth::logout();

        return redirect()->route('user_login')->with('success', 'You have been successfully logged out!');
    }
}
