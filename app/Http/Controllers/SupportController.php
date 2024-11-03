<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SiteSupportTicket; // Correct the model name (singular)
use Illuminate\Support\Facades\Auth;

class SupportController extends Controller
{
    // Show the ticket form
    public function create()
    {
        return view('tickets.create'); // Ensure you have the correct view path
    }

    // Handle form submission
    public function store(Request $request)
    {
        $request->validate([
            'ticket_type' => 'required|string',
            'message'     => 'required|string|max:2000',
        ]);

        // Store the ticket in the site_support_tickets table
        SiteSupportTicket::create([
            'ticket_type' => $request->ticket_type,
            'message'     => $request->message,
            'user_id'     => Auth::id(),
        ]);

        return redirect()->route('tickets.create')->with('success', 'Ticket submitted successfully!');
    }
}
