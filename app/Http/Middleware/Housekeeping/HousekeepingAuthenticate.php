<?php

namespace App\Http\Middleware\Housekeeping;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class HousekeepingAuthenticate
{
    public function handle($request, Closure $next)
    {
        if (!Auth::guard('housekeeping')->check()) {
            Log::warning('Housekeeping guard not authenticated.');
            return redirect()->route('housekeeping.login');
        }

        Log::info('Housekeeping guard authenticated:', ['user' => Auth::guard('housekeeping')->user()]);
        return $next($request);
    }
}