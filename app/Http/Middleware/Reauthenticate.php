<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ReAuthenticate
{
    public function handle($request, Closure $next)
    {
        // Only apply the check for the /client route
        if ($request->is('client') && Auth::check()) {
            $lastAuthenticated = session('client_last_authenticated_at', now());
            $timeout = 60; // Timeout in minutes

            // Check if 60 minutes have passed since last re-authentication
            if (now()->diffInMinutes($lastAuthenticated) >= $timeout) {
                session(['client_last_authenticated_at' => null]); // Reset the session key
                return redirect('/client/authenticate'); // Redirect to authenticate page
            }
        }

        return $next($request);
    }
}
