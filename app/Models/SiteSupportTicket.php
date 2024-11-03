<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User; // Import the User model

class SiteSupportTicket extends Model
{
    use HasFactory;

    // Specify the correct table name
    protected $table = 'site_support_tickets';

    // Define the fillable fields for mass assignment
    protected $fillable = ['ticket_type', 'message', 'user_id', 'handled_by'];

    // Define the relationship with the User (staff member who handled the ticket)
    public function handledBy()
    {
        return $this->belongsTo(User::class, 'handled_by');
    }
}

