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
        $onlineUsersCount = User::where('online', '1')->count();

        return $onlineUsersCount;
    }

    public function onlinePlayers()
{
    $onlineUsers = User::where('online', '1')
                       ->get()
                       ->map(function ($user) {
                           $user->last_login = Carbon::createFromTimestamp($user->last_login)
                                                      ->timezone('America/New_York'); // Ensure proper timezone
                           return $user;
                       });

    $totalUsers = User::count();

    return view('players', compact('onlineUsers', 'totalUsers'));
}
}