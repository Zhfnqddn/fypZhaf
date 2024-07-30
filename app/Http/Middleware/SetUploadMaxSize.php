<?php

namespace App\Http\Middleware;

use Closure;

class SetUploadMaxSize
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $maxSize = env('UPLOAD_MAX_SIZE', 51200); // Default to 50MB if not set

        ini_set('upload_max_filesize', $maxSize . 'K');
        ini_set('post_max_size', $maxSize . 'K');

        return $next($request);
    }
}
