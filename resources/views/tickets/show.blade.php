@extends('layouts.app')

@section('title', config('app.name') . ' - Tickets')

@section('content')
<main class="position-relative container justify-content-center py-4">
    <!-- Full-width Alert -->
    <div class="row">
        <div class="col-12">
            <div class="alert alert-warning w-100" role="alert">
                <span>This request is currently in the <strong>{{ strtolower($ticket->status) }}</strong>. A staff member will check this out soon.</span>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="row justify-content-center" style="margin-top: 15px;">
        <div class="col-lg-8 order-lg-1 order-2">
            <!-- Acknowledgment Alert -->
            <div class="alert alert-success">
                We have received your request, check back soon.
            </div>

            <!-- Ticket Initial Response -->
            <h5 class="silver">Ticket Initial Response</h5>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-2 col-2">
                            <img src="https://imager.habboon.pw/?figure={{ $ticket->user->look ?? 'default-avatar' }}&size=m&direction=3&head_direction=3&gesture=sml&headonly=1" data-toggle="tooltip" data-placement="top" title="{{ $ticket->user->username ?? 'User' }}">
                        </div>
                        <div class="col-lg-10 col-10">
                            <p>
                                <a href="#">{{ $ticket->user->username ?? 'User' }}</a> 
                                <small class="float-right text-muted">{{ $ticket->created_at->diffForHumans() }}</small>
                            </p>
                            <p class="text mb-0">{!! nl2br(e($ticket->message)) !!}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Automatic Response -->
            <h5 class="silver">Automatic Response</h5>
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-lg-2 col-2">
                            <img src="https://imager.habboon.pw?figure=hr-100.hd-180-1.ch-210-66.lg-270-82.sh-290-91&amp;size=m&amp;direction=3&amp;head_direction=3&amp;gesture=sml&amp;headonly=1" data-toggle="tooltip" data-placement="top" title="System">
                        </div>
                        <div class="col-lg-10 col-10">
                            <p><a href="#">System</a></p>
                            <p class="text">Your ticket has been escalated to Senior Moderation.</p>
                            <p class="text mb-0">We'll be in touch shortly.</p>
                        </div>
                    </div>
                </div>
            </div>

            <h5 class="silver">Response</h5>
@if (!empty($ticket->reply_message))
    <div class="card mb-2">
        <div class="card-body">
            <div class="row align-items-center">
                @if ($ticket->handledBy)
                    <!-- Staff Avatar -->
                    <div class="col-lg-2 col-2">
                        <img src="https://imager.habboon.pw/?figure={{ $ticket->handledBy->look ?? 'default_avatar' }}&size=m&direction=3&head_direction=3&gesture=sml&headonly=1" 
                             data-toggle="tooltip" 
                             data-placement="top" 
                             title="{{ $ticket->handledBy->username }}">
                    </div>

                    <!-- Staff Username and Message -->
                    <div class="col-lg-10 col-10">
                        <p>
                            <a href="#">{{ $ticket->handledBy->username }}</a>
                        </p>
                        <p class="text mb-0">{!! nl2br(e($ticket->reply_message)) !!}</p>
                    </div>
                @else
                    <p class="text-danger">No staff assigned to this ticket.</p>
                @endif
            </div>
        </div>
    </div>
@else
    <div class="alert alert-danger">Staff have not responded yet.</div>
@endif
        </div>

        <!-- Right Sidebar -->
        <div class="col-lg-4 order-lg-2 order-1">
            <!-- Add any content for the sidebar here -->
        </div>
    </div>
</main>

@endsection
