<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $primaryKey = 'pay_ID';

    protected $fillable = [
        'pay_Date', 
        'pay_Time', 
        'booking_ID'
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_ID');
    }
}
