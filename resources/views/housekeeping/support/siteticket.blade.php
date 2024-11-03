@extends('housekeeping.app')

@section('title')
    {{ config('app.name') }} - Site Tickets
@endsection

@section('content')
<div class="container">

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <h2>Site Support Tickets</h2>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Ticket Type</th>
                <th>Message</th>
                <th>Submitted At</th>
                <th>Handled By</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tickets as $ticket)
            <tr>
                <td>{{ $ticket->id }}</td>
                <td>{{ ucfirst(str_replace('_', ' ', $ticket->ticket_type)) }}</td>
                <td>{{ \Illuminate\Support\Str::limit($ticket->message, 100) }}</td>
                <td>{{ $ticket->created_at->format('Y-m-d H:i') }}</td>
            <td>
                {{ $ticket->handled_by ?? 'Not Handled' }}
            </td>


                <td>
                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#handleTicketModal" data-id="{{ $ticket->id }}">
                        Handle Ticket
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination controls -->
    {{ $tickets->links() }}
</div>

<!-- Modal for handling ticket -->
<div class="modal fade" id="handleTicketModal" tabindex="-1" aria-labelledby="handleTicketLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="handleTicketLabel">Handle Ticket</h5>
            </div>
            <form id="handleTicketForm" method="POST" action="{{ route('housekeeping.support.handle') }}">
    @csrf
    <div class="modal-body">
        <input type="hidden" name="ticket_id" id="ticket_id" value="">

        <!-- Ensure the user is authenticated and has a username -->
        @if(Auth::check())
            <input type="hidden" name="handled_by" value="{{ Auth::user()->username ?? Auth::user()->name }}">
        @else
            <p>Error: No user is authenticated to handle this ticket.</p>
        @endif

        <!-- Textarea for the reply message -->
        <div class="form-group">
            <label for="reply_message">Reply Message</label>
           <textarea name="reply_message" id="reply_message" class="form-control" rows="4" required></textarea>
        </div>

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Mark as Handled</button>
    </div>
</form>

        </div>
    </div>
</div>

<!-- JavaScript to pass the ticket ID to the modal -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var handleTicketModal = document.getElementById('handleTicketModal');
        
        handleTicketModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget; // Button that triggered the modal
            var ticketId = button.getAttribute('data-id'); // Extract info from data-* attributes
            var modal = this;
            modal.querySelector('.modal-body #ticket_id').value = ticketId;
        });
    });
</script>

@endsection
