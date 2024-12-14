<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle($request, Closure $next, ...$guards)
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            // Redirect to the dashboard if accessing the homepage or login page
            if ($request->is('/')) {
                return redirect('/dashboard');
            }
        }

        return $next($request);
    }
}
