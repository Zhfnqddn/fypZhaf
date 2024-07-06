<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ViewCustController extends Controller
{
    public function viewCust()
    {
        $customer = Auth::user();
        return view('cust.viewCust', compact('customer'));
    }

    public function updateCust(Request $request)
    {
        $customer = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('customers', 'cust_Email')->ignore($customer->cust_ID, 'cust_ID'),
            ],
            'password' => 'nullable|string|min:8|confirmed',
            'phone' => [
                'required',
                'string',
                'regex:/^01[0-9]{8,9}$/'
            ]
        ]);

        $customer->cust_Name = $request->name;
        $customer->cust_Email = $request->email;
        $customer->cust_PhoneNum = $request->phone;

        if ($request->password) {
            $customer->cust_Password = Hash::make($request->password);
        }

        $customer->save();

        return redirect()->route('viewCust')->with('success', 'Profile updated successfully.');
    }
}