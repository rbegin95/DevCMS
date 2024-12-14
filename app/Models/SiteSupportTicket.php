<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSupportTicket extends Model
{
    use HasFactory;

    // Specify the correct table name
    protected $table = 'site_support_tickets';

    // Define the fillable fields for mass assignment
    protected $fillable = ['ticket_type', 'message', 'status', 'user_id', 'handled_by', 'reply_message'];

    /**
     * Add a single reply to the ticket.
     *
     * @param string $reply
     * @return void
     */
    public function addReply(string $reply)
    {
        $this->update(['reply_message' => $reply]);
    }

    /**
     * Get the user who created the ticket.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Get the staff member who handled the ticket.
     */
    public function handledBy()
    {
        return $this->belongsTo(User::class, 'handled_by', 'username');
    }
}
