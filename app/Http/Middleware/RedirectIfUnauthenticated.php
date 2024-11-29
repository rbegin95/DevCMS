<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfUnauthenticated
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
        // Redirect unauthenticated users to the homepage
        if (!Auth::check()) {
            return redirect('/'); // Replace `/` with the route to your login page
        }

        return $next($request);
    }
}
