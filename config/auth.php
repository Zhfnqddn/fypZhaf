<?php

return [

    'defaults' => [
        'guard' => 'customer', // Default to customer guard
        'passwords' => 'customers',
    ],

    'guards' => [
        'customer' => [
            'driver' => 'session',
            'provider' => 'customers',
        ],
        'staff' => [
            'driver' => 'session',
            'provider' => 'staff',
        ],
    ],

    'providers' => [
        'customers' => [
            'driver' => 'eloquent',
            'model' => App\Models\Customer::class,
        ],
        'staff' => [
            'driver' => 'eloquent',
            'model' => App\Models\Staff::class,
        ],
    ],

    'passwords' => [
        'customers' => [
            'provider' => 'customers',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],
        'staff' => [
            'provider' => 'staff',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => 10800,

];
