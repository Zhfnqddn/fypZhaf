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
        'staff_ID',  // Add this line
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

    // Define the relationship with PackageDetail
    public function packageDetails()
    {
        return $this->hasMany(PackageDetail::class, 'booking_id', 'booking_ID');
    }

    // Add a relationship to the Staff model if you have one
    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staff_ID');
    }
}
