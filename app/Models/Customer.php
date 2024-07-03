<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    use HasFactory;

    protected $primaryKey = 'cust_ID';

    protected $fillable = [
        'cust_Name', 
        'cust_Email', 
        'cust_Password', 
        'cust_PhoneNum'
    ];

    protected $hidden = [
        'cust_Password', 
        'remember_token'
    ];

    public function getAuthPassword()
    {
        return $this->cust_Password;
    }

    public function getNameAttribute()
    {
        return $this->cust_Name;
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'cust_ID');
    }
}
