<?php

namespace App\Http\Middleware;

use Closure;

class SetUploadMaxSize
{
    public function handle($request, Closure $next)
    {
        // Set to the environment variable value or default to 50MB
        ini_set('upload_max_filesize', env('UPLOAD_MAX_SIZE', '50M') . 'K');
        ini_set('post_max_size', env('UPLOAD_MAX_SIZE', '50M') . 'K');

        return $next($request);
    }
}

