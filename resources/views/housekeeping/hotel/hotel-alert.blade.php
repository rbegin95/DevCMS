@extends('housekeeping.app')

@section('title')
    {{ config('app.name') }} - Hotel Alert
@endsection

@section('content')
<form method="POST" action="{{ route('housekeeping.hotel.alert') }}">
    @csrf
    <label for="message">Alert Message:</label>
    <textarea id="message" name="message" required></textarea>
    <button type="submit">Send Hotel Alert</button>
</form>
@endsection