<?php

namespace App\Http\Controllers\Housekeeping;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\RconService;

class HotelAlertRCONController extends Controller
{
    protected $rconService;

    public function __construct(RconService $rconService)
    {
        $this->rconService = $rconService;
    }

    public function show()
    {
        return view('housekeeping.hotel.hotel-alert'); 
    }

    public function sendHotelAlert(Request $request)
    {
        // Validate the input
        $request->validate([
            'message' => 'required|string|max:255',
        ]);

        // Get the message from the request
        $message = $request->input('message');

        // Send the alert using RconService
        $response = $this->rconService->alertHotel($message);

        // Check the response and return feedback
        if ($response) {
            return back()->with('success', 'Hotel alert sent successfully!');
        } else {
            return back()->with('error', 'Failed to send hotel alert.');
        }
    }
}
