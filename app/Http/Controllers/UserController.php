<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function onlineUsersCount()
    {
        $onlineUsersCount = User::where('online', 1)->count();

        return $onlineUsersCount;
    }

    public function onlinePlayers()
    {
        $now = Carbon::now('America/New_York'); // Use the correct timezone
        $threshold = $now->copy()->subMinutes(5)->toDateTimeString(); // Convert to string

        // Direct query for debugging
        $onlineUsers = User::whereRaw("STR_TO_DATE(last_login, '%Y-%m-%d %H:%i:%s') >= ?", [$threshold])
                           ->where('hide_online', '0') // 0 for false
                           ->get()
                           ->map(function ($user) {
                               $user->last_login = Carbon::createFromFormat('Y-m-d H:i:s', $user->last_login, 'America/New_York');
                               return $user;
                           });

        $totalUsers = User::count();

        return view('players', compact('onlineUsers', 'totalUsers'));
    }
}
