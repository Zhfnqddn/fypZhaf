<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ConfigController extends Controller
{
    public function checkPhpConfig()
    {
        Log::info('upload_max_filesize: ' . ini_get('upload_max_filesize'));
        Log::info('post_max_size: ' . ini_get('post_max_size'));

        return response()->json([
            'upload_max_filesize' => ini_get('upload_max_filesize'),
            'post_max_size' => ini_get('post_max_size'),
        ]);
    }
}
