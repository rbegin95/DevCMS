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

    protected $rconService;

    public function __construct(RconService $rconService)
    {
        $this->rconService = $rconService;
    }

    public function sendHotelAlert(Request $request)
{

    dd($request->all());
    $alertMessage = $request->input('message');

    if (is_null($alertMessage)) {
        return response()->json(['success' => false, 'message' => 'Message is missing from the request.']);
    }

    try {
        $response = $this->rconService->alertHotel($alertMessage);
        return response()->json(['success' => true, 'message' => 'Hotel alert sent successfully.', 'response' => $response]);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => 'Failed to send alert: ' . $e->getMessage()]);
    }
    }
}