<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageDetail extends Model
{
    use HasFactory;

    protected $primaryKey = 'package_detail_ID';

    protected $fillable = [
        'add_Hours', 
        'add_Ons', 
        'add_Session', 
        'add_Location', 
        'package_ID',
        'status'
    ];

    protected $casts = [
        'addOn' => 'array',
        'addSession' => 'array',
        'addLocation' => 'array',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'cust_ID');
    }

    public function package()
    {
        return $this->belongsTo(Package::class, 'package_ID');
    }

    // Define the relationship with Booking
    public function booking()
    {
        return $this->hasOne(Booking::class, 'package_detail_ID');
    }
}
