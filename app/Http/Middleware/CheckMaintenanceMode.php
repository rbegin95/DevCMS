<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckMaintenanceMode
{
    public function handle(Request $request, Closure $next)
    {
        // Check if maintenance mode is enabled
        $maintenanceMode = \App\Models\WebsiteSetting::first()->maintenance_mode;

        // Check if the user is trying to access the maintenance page
        if ($request->is('maintenance')) {
            return $next($request); // Allow access to the maintenance page
        }

        if ($request->is('housekeeping*')) {
        return $next($request);
        }

        // If maintenance mode is enabled and the user is not a staff member, redirect to /maintenance
        if ($maintenanceMode == 'true' && !(Auth::check() && Auth::user()->is_staff)) {
            return redirect('/maintenance');
        }

        return $next($request);
    }
}
