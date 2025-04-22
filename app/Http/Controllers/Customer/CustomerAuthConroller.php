<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerAuthConroller extends Controller
{
    public function login()
    {

        return view('user.pages.customer.auth.login');
    }
}
