<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $primaryKey = 'video_ID';

    protected $fillable = [
        'video_Name', 
        'video_FilePath', 
        'staff_ID'
    ];

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staff_ID');
    }
}
