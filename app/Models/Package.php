<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $primaryKey = 'package_ID';

    protected $fillable = [
        'package_Name', 
        'service_Type', 
        'price_range', 
        'start_Date',
        'end_Date',
        'time_From',
        'time_To',
        'location',
        'staff_ID'
    ];

    public function details()
    {
        return $this->hasMany(PackageDetail::class, 'package_ID');
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staff_ID');
    }
}
