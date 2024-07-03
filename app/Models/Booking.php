<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $primaryKey = 'booking_ID';

    protected $fillable = [
        'start_Date', 
        'end_Date', 
        'time_from', 
        'time_to', 
        'total_price', 
        'booking_status', 
        'cust_ID', 
        'package_ID'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'cust_ID');
    }

    public function package()
    {
        return $this->belongsTo(Package::class, 'package_ID');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'booking_ID');
    }
}
