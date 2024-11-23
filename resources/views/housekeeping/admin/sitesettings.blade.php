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

<form action="{{ route('housekeeping.admin.sitesettings.update') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="staff_application_tab_visible">Staff Application Tab</label>
        <select id="staff_application_tab_visible" name="staff_application_tab_visible" class="form-control" style="width: 150px;">
            <option value="true" {{ $staffApplicationTabVisible == 'true' ? 'selected' : '' }}>True</option>
            <option value="false" {{ $staffApplicationTabVisible == 'false' ? 'selected' : '' }}>False</option>
        </select>
    </div>
    <br />

    <div class="form-group">
        <label for="maintenance_mode">Maintenance Mode</label>
        <select id="maintenance_mode" name="maintenance_mode" class="form-control" style="width: 150px;">
            <option value="true" {{ $maintenanceMode == 'true' ? 'selected' : '' }}>True</option>
            <option value="false" {{ $maintenanceMode == 'false' ? 'selected' : '' }}>False</option>
        </select>
    </div>
    <br />

    <button type="submit" class="btn btn-primary">Save</button>
</form>
@endsection