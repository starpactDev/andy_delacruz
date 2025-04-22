<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SecretaryExpenseReportController extends Controller
{
    public function index()
    {
        return view('user.pages.secretary.expense_report_domrep.index');
    }
}
