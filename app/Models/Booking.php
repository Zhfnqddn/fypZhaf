<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $primaryKey = 'booking_ID';

    protected $fillable = [
        'total_Price',
        'booking_Status',
        'custom_Status',
        'cust_ID',
        'package_ID',
        'package_detail_ID',
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
