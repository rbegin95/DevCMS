<?php

namespace App\Http\Controllers\Housekeeping;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Ban;
use App\Models\Permission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('housekeeping.users.index', compact('users'));
    }

   public function search(Request $request)
    {
    $request->validate([
        'search' => 'required|string|max:255',
    ]);

    $searchTerm = $request->search;

    $users = User::where('username', 'like', '%' . $searchTerm . '%')
                ->orWhere('ip_register', $searchTerm)
                ->get();

    if ($request->ajax()) {
        return response()->json($users);
    }

    return view('housekeeping.users.index', compact('users'));
    }

    public function clones(User $user)
    {
    $users = User::query()
        ->select(['id', 'username', 'email', 'motto', 'rank', 'look', 'online', 'ip_current', 'last_online'])
        ->whereIn('ip_current', [$user->ip_current, $user->ip_register])
        ->orWhereIn('ip_register', [$user->ip_current, $user->ip_register])
        ->paginate(15);

    return view('housekeeping.users.index', compact('users'));
    }

    public function edit(User $user)
    {
        $ranks = Permission::all();
        $currentRank = Permission::find($user->rank);
        return view('housekeeping.users.edit', compact('user', 'ranks', 'currentRank'));
    }

    public function update(Request $request, User $user)
    {
        
        Log::info('Updating user:', $request->all());
        $request->validate([
            'motto' => 'required|string|max:255',
            'rank' => 'required|integer',
            'diamonds' => 'required|integer',
            'duckets' => 'required|integer',
            'credits' => 'required|integer',
            'gotw_points' => 'required|integer',
        ]);

        $user->motto = $request->motto;
        $user->rank = $request->rank;
        $user->points = $request->diamonds;
        $user->pixels = $request->duckets;
        $user->credits = $request->credits;
        $user->gotw_points = $request->gotw_points;

        $user->save();
         Log::info('User updated:', $user->toArray());
        return redirect()->route('housekeeping.users.edit', $user->id)->with('success', 'User updated successfully');
    }

    public function banUser(Request $request, User $user)
    {
    Log::info('Reached banUser method');

    $request->validate([
        'ban_reason' => 'required|string|max:255',
        'ban_expire' => 'required|date_format:Y-m-d\TH:i',
        'ban_type' => 'required|string|in:account,ip,machine,super', // Add all possible enum values
    ]);

    $userStaffId = Auth::guard('housekeeping')->id();
    if (!$userStaffId) {
        Log::error('User not authenticated or user_staff_id is null');
        return redirect()->route('housekeeping.users.index')->with('error', 'You must be logged in to ban a user.');
    }

    Log::info('Banning user', [
        'user_id' => $user->id,
        'ban_reason' => $request->ban_reason,
        'ban_expire' => strtotime($request->ban_expire),
        'ip' => $request->ban_type === 'ip' ? $user->ip ?? '0.0.0.0' : null,
        'type' => $request->ban_type,
        'user_staff_id' => $userStaffId,
        'timestamp' => time(),
    ]);

    try {
        $ban = Ban::create([
            'user_id' => $user->id,
            'ban_reason' => $request->ban_reason,
            'ban_expire' => strtotime($request->ban_expire),
            'ip' => $request->ban_type === 'ip' ? $user->ip ?? '0.0.0.0' : null,
            'type' => $request->ban_type,
            'user_staff_id' => $userStaffId,
            'timestamp' => time(),
        ]);

        Log::info('Ban created', ['ban' => $ban]);
    } catch (\Exception $e) {
        Log::error('Error creating ban', ['error' => $e->getMessage()]);
        return redirect()->route('housekeeping.users.index')->with('error', 'Error banning user.');
    }

    return redirect()->route('housekeeping.users.index')->with('success', 'User banned successfully');
    }
}

