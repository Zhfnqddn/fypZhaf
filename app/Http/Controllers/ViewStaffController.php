<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ViewStaffController extends Controller
{
    public function viewStaff()
    {
        $staff = Auth::user();
        return view('staff.viewStaff', compact('staff'));
    }

    public function updateStaff(Request $request)
    {
        $staff = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('staff', 'staff_Email')->ignore($staff->staff_ID, 'staff_ID'),
            ],
            'password' => 'nullable|string|min:8|confirmed',
            'phone' => [
                'required',
                'string',
                'regex:/^01[0-9]{8,9}$/'
            ]        
        ]);

        $staff->staff_Name = $request->name;
        $staff->staff_Email = $request->email;
        $staff->staff_PhoneNum = $request->phone;

        if ($request->password) {
            $staff->staff_Password = Hash::make($request->password);
        }

        $staff->save();

        return redirect()->route('viewStaff')->with('success', 'Profile updated successfully.');
    }
}