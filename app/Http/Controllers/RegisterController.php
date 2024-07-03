<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|min:4|max:255',
                'email' => 'required|string|email|max:255|unique:customers,cust_Email|unique:staff,staff_Email',
                'password' => 'required|string|min:8|confirmed',
                'phone' => ['nullable', 'regex:/^(01[0-9]{8}|011[0-9]{8})$/'],
                'role' => 'required|in:photographer,videographer,customer',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            if (in_array($request->role, ['photographer', 'videographer'])) {
                Staff::create([
                    'staff_Name' => $request->name,
                    'staff_Role' => $request->role,
                    'staff_Email' => $request->email,
                    'staff_Password' => Hash::make($request->password),
                    'staff_PhoneNum' => $request->phone,
                ]);
            } else if ($request->role === 'customer') {
                Customer::create([
                    'cust_Name' => $request->name,
                    'cust_Email' => $request->email,
                    'cust_Password' => Hash::make($request->password),
                    'cust_PhoneNum' => $request->phone,
                ]);
            }

            return redirect()->route('register')->with('status', 'Account Successfully Registered!');
        }
        return view('register');
    }
}
