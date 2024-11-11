<?php

namespace App\Http\Controllers\Housekeeping;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BannedUsersController extends Controller
{
    public function index()
{
    // Fetch data from the bans table with joins to get both the banned user's and staff's usernames
    $bannedUsers = DB::table('bans')
        ->join('users as banned_users', 'bans.user_id', '=', 'banned_users.id')
        ->join('users as staff_users', 'bans.user_staff_id', '=', 'staff_users.id')
        ->select(
            'bans.id',
            'banned_users.username as banned_username',
            'bans.ip', // Include the original IP to ensure it can be masked properly
            DB::raw("CONCAT(SUBSTRING_INDEX(bans.ip, '.', 1), '.x.x.', SUBSTRING_INDEX(bans.ip, '.', -1)) AS masked_ip"),
            'staff_users.username as staff_username',
            'bans.timestamp',
            'bans.ban_reason'
        )
        ->get();

    // Return view with the data
    return view('housekeeping.users.bannedusers', compact('bannedUsers'));
}
    // Function to unban (delete a ban)
    public function destroy($id)
    {
        // Delete the ban record by ID
        DB::table('bans')->where('id', $id)->delete();

        // Redirect back with a success message
        return redirect()->route('housekeeping.users.bannedusers')->with('success', 'User has been unbanned successfully.');
    }
}
