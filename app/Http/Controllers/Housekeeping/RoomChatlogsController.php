<?php

namespace App\Http\Controllers\Housekeeping;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Import for using raw queries or DB facade

class RoomChatlogsController extends Controller
{
    public function getRoomChats(Request $request)
    {
        // Get the search query from the request
        $search = $request->input('search');

        // Query to get chat logs, joining with the users table to search by username
        $chatLogs = DB::table('chatlogs_room')
            ->leftJoin('users', 'chatlogs_room.user_from_id', '=', 'users.id')
            ->select('chatlogs_room.*', 'users.username')
            ->when($search, function ($query, $search) {
                return $query->where('users.username', 'like', '%' . $search . '%')
                             ->orWhere('chatlogs_room.room_id', 'like', '%' . $search . '%');
            })
            ->orderBy('chatlogs_room.timestamp', 'desc')
            ->paginate(20);

            logHousekeepingActivity("User: " . auth()->user()->username . " has viewed roomchatlogs chatlogs");
        // Pass the data and search term to the view
        return view('housekeeping.hotel.roomchatlogs', ['chatLogs' => $chatLogs, 'search' => $search]);
    }
}
