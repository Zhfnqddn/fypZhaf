<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UpdCustController extends Controller
{
public function updCust()
{
return view('cust\updCust');
}
}