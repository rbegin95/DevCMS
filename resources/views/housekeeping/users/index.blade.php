@extends('housekeeping.app')

@section('title')
    Housekeeping - Users
@endsection

@section('content')
 @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
 <h2>Search for Users</h2>
<form action="{{ route('housekeeping.users.search') }}" method="GET">
    <div class="form-group">
        <label for="search">Username or IP:</label>
        <input type="text" name="search" id="search" class="form-control" required>
    </div>
    <br />
    <button type="submit" class="btn btn-primary">Search</button>
</form>
<div class="row mt-4">
        <div class="col-md-12">
            <h2>All Users</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                             <a href="{{ route('housekeeping.users.edit', $user->id) }}" class="btn btn-primary">
                            <i class="fas fa-pencil-alt"></i>
                            </a>
                            <a href="{{ route('housekeeping.users.clones', $user->id) }}" class="btn btn-warning text-white">
                            <i class="fas fa-eye"></i>
                            </a>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#banModal" data-user-id="{{ $user->id }}" data-username="{{ $user->username }}">
                            <i class="fas fa-ban"></i>
                        </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Ban User Modal -->
   <div class="modal fade" id="banModal" tabindex="-1" role="dialog" aria-labelledby="banModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="banModalLabel">Ban User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('housekeeping.banUser', 0) }}" id="banForm">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="ban_reason">Ban Reason</label>
                        <textarea id="ban_reason" name="ban_reason" class="form-control @error('ban_reason') is-invalid @enderror" required></textarea>

                        @error('ban_reason')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="ban_expire">Ban Expiry</label>
                        <input type="datetime-local" id="ban_expire" name="ban_expire" class="form-control @error('ban_expire') is-invalid @enderror" required>
                        
                        @error('ban_expire')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="ban_type">Ban Type</label>
                        <select id="ban_type" name="ban_type" class="form-control @error('ban_type') is-invalid @enderror" required>
                            <option value="account">Account</option>
                            <option value="ip">IP</option>
                            <option value="machine">Machine</option>
                            <option value="super">Super</option>
                        </select>
                        
                        @error('ban_type')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Ban User</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var banModal = document.getElementById('banModal');
        banModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget; // Button that triggered the modal
            var userId = button.getAttribute('data-user-id'); // Extract info from data-* attributes
            var username = button.getAttribute('data-username'); // Extract info from data-* attributes

            var modalTitle = banModal.querySelector('.modal-title');
            var form = banModal.querySelector('form');
            modalTitle.textContent = 'Ban User: ' + username;
            form.action = '/housekeeping/users/' + userId + '/ban';
        });
    });
</script>
@endsection
