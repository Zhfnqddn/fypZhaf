<?php

namespace App\Http\Middleware;

use Closure;

class SetUploadMaxSize
{
    public function handle($request, Closure $next)
    {
        // Set to 100MB for testing purposes
        ini_set('upload_max_filesize', '100M');
        ini_set('post_max_size', '100M');

        return $next($request);
    }
}

