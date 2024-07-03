<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class StaffMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::guard('staff')->check()) {
            return $next($request);
        }

        return redirect('/login');
    }
}
