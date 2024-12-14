<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\WebsiteSetting; // Add this line to import the WebsiteSetting model

class CheckMaintenanceMode
{
    public function handle(Request $request, Closure $next)
    {
        // Check if maintenance mode is enabled
        $maintenanceMode = WebsiteSetting::first()->maintenance_mode;

        if ($maintenanceMode === 'true' && (!Auth::check() || !Auth::user()->isStaff())) {
            return redirect('/maintenance');
        }

        return $next($request);
    }
}
