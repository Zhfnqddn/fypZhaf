<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    use HasFactory;

    protected $primaryKey = 'picture_ID';

    protected $fillable = [
        'picture_Name', 
        'picture_FilePath', 
        'staff_ID'
    ];

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staff_ID');
    }
}
