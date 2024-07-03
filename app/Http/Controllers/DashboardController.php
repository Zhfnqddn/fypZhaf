<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function dashboard()
    {
        if (Auth::guard('customer')->check()) {
            return view('cust.dashboard', ['user' => Auth::guard('customer')->user()]);
        }

        return redirect()->route('login');
    }

    public function dashboardStaff()
    {
        if (Auth::guard('staff')->check()) {
            return view('staff.dashboardStaff', ['user' => Auth::guard('staff')->user()]);
        }

        return redirect()->route('login');
    }
}
