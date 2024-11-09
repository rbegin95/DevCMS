<?php

namespace App\Http\Controllers;

use App\Services\RCONService;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\News;

class HousekeepingController extends Controller
{
    public function index()
    {
        // Fetch necessary data and pass it to the view
        $users = User::all();
        $news = News::all();
        return view('housekeeping.dashboard', compact('users', 'news'));
    }

    public function banUser(Request $request, User $user)
    {
        $user->update(['banned' => true]); // Assuming you have a banned column
        return redirect()->route('housekeeping.dashboard')->with('status', 'User banned successfully!');
    }

}