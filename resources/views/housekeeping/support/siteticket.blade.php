@extends('housekeeping.app')

@section('title', config('app.name') . ' - Site Support Tickets')

@section('content')
<div class="container py-4">

    <!-- Success Alert -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Page Heading -->
    <h2 class="mb-4">Site Support Tickets</h2>

    <!-- Tickets Table -->
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Type</th>
                    <th>Message</th>
                    <th>Submitted At</th>
                    <th>Handled By</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tickets as $ticket)
                    <tr>
                        <td>{{ $ticket->id }}</td>
                        <td>{{ ucfirst(str_replace('_', ' ', $ticket->ticket_type)) }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($ticket->message, 60, '...') }}</td>
                        <td>{{ $ticket->created_at->format('Y-m-d H:i') }}</td>
                        <td>{{ $ticket->handled_by ?? 'Not Handled' }}</td>
                        <td>
                            <span class="badge {{ $ticket->status == 'Queued' ? 'bg-warning' : 'bg-danger' }}">
                                {{ ucfirst($ticket->status) }}
                            </span>
                        </td>
                        <td>
                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#handleTicketModal" data-id="{{ $ticket->id }}">
                                Handle Ticket
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">No tickets found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $tickets->links() }}
    </div>

    <!-- Modal for Handling Tickets -->
    <div class="modal fade" id="handleTicketModal" tabindex="-1" aria-labelledby="handleTicketLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form id="handleTicketForm" method="POST" action="{{ route('housekeeping.support.handle') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="handleTicketLabel">Handle Ticket</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="ticket_id" id="ticket_id" value="">

                        <!-- Ensure the user is authenticated -->
                        @if(Auth::check())
                            <input type="hidden" name="handled_by" value="{{ Auth::user()->username ?? Auth::user()->name }}">
                        @else
                            <p class="text-danger">Error: No authenticated user to handle this ticket.</p>
                        @endif

                        <!-- Reply Message -->
                        <div class="form-group mb-3">
                            <label for="reply_message" class="form-label">Reply Message</label>
                            <textarea name="reply_message" id="reply_message" class="form-control" rows="4" placeholder="Enter your reply here..." required></textarea>
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
</div>

<!-- JavaScript for Passing Ticket ID to Modal -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var handleTicketModal = document.getElementById('handleTicketModal');
        handleTicketModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var ticketId = button.getAttribute('data-id');
            this.querySelector('#ticket_id').value = ticketId;
        });
    });
</script>
@endsection
