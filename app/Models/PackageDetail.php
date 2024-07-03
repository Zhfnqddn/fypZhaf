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
        'package_ID'
    ];

    public function package()
    {
        return $this->belongsTo(Package::class, 'package_ID');
    }
}
