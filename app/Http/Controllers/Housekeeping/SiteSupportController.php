<?php

namespace App\Http\Controllers\Housekeeping;

use App\Http\Controllers\Controller;
use App\Models\SiteSupportTicket; // Ensure the Support model is imported
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiteSupportController extends Controller
{
    // Fetch all support tickets
    public function index()
    {
        $tickets = SiteSupportTicket::paginate(10); // You can adjust the pagination limit
        return view('housekeeping.support.siteticket', compact('tickets'));
    }

    // Optional: Add a method to show a specific ticket in detail
    public function show($id)
    {
        $ticket = SiteSupportTicket::findOrFail($id);
        return view('housekeeping.support.show', compact('ticket'));
    }

    public function handle(Request $request)
{
    // Validate the input
    $request->validate([
        'ticket_id' => 'required|exists:site_support_tickets,id', // Ensure ticket exists
        'reply_message' => 'required|string|max:2000', // Adjust as needed
    ]);

    // Find the ticket by ID
    $ticket = SiteSupportTicket::findOrFail($request->ticket_id);

    // Update the ticket fields
    $ticket->update([
        'handled_by' => Auth::user()->username, // Store the staff member's username
        'reply_message' => $request->reply_message, // Store the reply message
        'status' => 'Closed', // Update the status to 'Handled'
    ]);

    // Redirect back with a success message
    return redirect()->route('housekeeping.support.siteticket')->with('success', 'Reply sent, and ticket marked as handled.');
}

}