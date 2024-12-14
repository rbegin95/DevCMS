<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SiteSupportTicket; // Ensure this matches your model
use Illuminate\Support\Facades\Auth;

class SupportController extends Controller
{
    // Show all tickets for the logged-in user
    public function index()
    {
        $tickets = SiteSupportTicket::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
        return view('tickets.index', compact('tickets')); // Ensure the correct view path
    }

    // Show the form to create a new ticket
    public function create()
    {
        return view('tickets.create'); // Ensure the correct view exists
    }

    public function show($id)
{
    $ticket = SiteSupportTicket::with(['handledBy'])->findOrFail($id);

    return view('tickets.show', compact('ticket'));
}

    public function respond(Request $request, $id)
{
    $request->validate([
        'reply_message' => 'required|string|max:2000', // Limit reply length as needed
    ]);

    $ticket = SiteSupportTicket::findOrFail($id);

    // Add the reply
    $ticket->addReply($request->input('reply_message'));

    return redirect()->back()->with('success', 'Reply added successfully!');
}

    // Handle storing a new ticket
    public function store(Request $request)
    {
        $request->validate([
            'ticket_type' => 'required|string',
            'message'     => 'required|string|max:2000',
        ]);

        // Create the new ticket
        SiteSupportTicket::create([
            'ticket_type' => $request->ticket_type,
            'message'     => $request->message,
            'user_id'     => Auth::id(),
            'status'      => 'Queued', // Set default status
        ]);

        return redirect()->route('tickets.index')->with('success', 'Ticket submitted successfully!');
    }
}
