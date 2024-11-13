@extends('housekeeping.app')

@section('title')
    Housekeeping - Site Settings
@endsection

@section('content')
<div class="container my-4">
    <h1>Site Settings</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('housekeeping.admin.sitesettings.stafftab') }}" method="POST">
        @csrf
        <div class="form-check mb-3">
            <input type="checkbox" class="form-check-input" name="staff_application_tab_visible" 
                id="staffApplicationTabVisible" {{ $staffApplicationTabVisible == 'true' ? 'checked' : '' }}>
            <label class="form-check-label" for="staffApplicationTabVisible">Show Staff Application Tab</label>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
@endsection