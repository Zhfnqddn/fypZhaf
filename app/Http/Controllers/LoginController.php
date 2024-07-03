<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        \Log::info('Attempting login', ['email' => $credentials['email']]);

        // Attempt to login as customer
        if (Auth::guard('customer')->attempt(['cust_Email' => $credentials['email'], 'password' => $credentials['password']], $request->remember)) {
            \Log::info('Customer login successful');
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        // Attempt to login as staff
        if (Auth::guard('staff')->attempt(['staff_Email' => $credentials['email'], 'password' => $credentials['password']], $request->remember)) {
            \Log::info('Staff login successful');
            $request->session()->regenerate();
            return redirect()->intended('dashboardStaff');
        }

        \Log::error('Login attempt failed');
        throw ValidationException::withMessages([
            'email' => [trans('auth.failed')],
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('customer')->logout();
        Auth::guard('staff')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
