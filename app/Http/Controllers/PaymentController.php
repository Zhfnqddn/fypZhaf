<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function payment()
    {
        return view('cust.payment');
    }

    public function index()
    {
        return view('index');
    }

    public function checkout()
    {
         \Stripe\Stripe::setApiKey(config(key:'stripe.sk'));

         $session = \Stripe\Checkout\Session::create([
            'line_items' => [
                 [
                    'price_data'=> [
                        'currency'=> 'MYR',
                        'product_data'=> [
                        'name' => 'Send me Money!!!',
                    ],
                    'unit_ammount' => 500,
                ],
                 'quantity' => 1,   
            ],
        ],
        'mode'  => 'payment',
        'success_url' => route('success'),
        'cancel_url' => route('index'),
        ]);

        return redirect()->away($session->url);
    }

    public function success()
    {
        return view('index');
    }
}