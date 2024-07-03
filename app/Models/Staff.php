<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Staff extends Authenticatable
{
    use HasFactory;

    protected $primaryKey = 'staff_ID';

    protected $fillable = [
        'staff_Name', 
        'staff_Role', 
        'staff_Email', 
        'staff_Password', 
        'staff_PhoneNum'
    ];

    protected $hidden = [
        'staff_Password', 
        'remember_token'
    ];

    public function getAuthPassword()
    {
        return $this->staff_Password;
    }

     public function getNameAttribute()
     {
         return $this->staff_Name;
     }

    public function packages()
    {
        return $this->hasMany(Package::class, 'staff_ID');
    }

    public function pictures()
    {
        return $this->hasMany(Picture::class, 'staff_ID');
    }

    public function videos()
    {
        return $this->hasMany(Video::class, 'staff_ID');
    }
}
