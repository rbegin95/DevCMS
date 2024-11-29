<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, ...$guards)
    {
        // If the user is authenticated
        if (Auth::check()) {
            // Redirect to /dashboard if the user is trying to access the login page (/)
            if ($request->is('/')) {
                return redirect('/dashboard');
            }

            // Allow access to protected pages
            return $next($request);
        }

        // If the user is not authenticated (session expired)
        // Redirect to / (homepage or login page)
        return redirect('/');
    }
}