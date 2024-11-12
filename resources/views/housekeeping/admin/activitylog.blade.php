@extends('housekeeping.app')

@section('title')
    Housekeeping - Activity Logs
@endsection

@section('content')
    <div class="container my-4">
    <h1 class="mb-4">Activity Log</h1>
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Staff</th>
                    <th scope="col">IP Address</th>
                    <th scope="col">Action</th>
                    <th scope="col">Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($logs as $log)
                    <tr>
                        <td>{{ $log->user->username ?? 'Unknown' }}</td>
                        <td>{{ $log->ip_address }}</td>
                        <td>{{ $log->action_performed }}</td>
                        <td>{{ $log->created_at->format('Y-m-d H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-center">
        {{ $logs->links() }}
    </div>
</div>
@endsection
