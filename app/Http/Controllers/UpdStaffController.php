<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UpdStaffController extends Controller
{
public function updStaff()
{
return view('staff.updStaff');
}
}