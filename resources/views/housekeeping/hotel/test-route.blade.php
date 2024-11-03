<form method="POST" action="{{ route('housekeeping.hotel.alert') }}">
    @csrf
    <label for="message">Alert Message:</label>
    <textarea id="message" name="message" required></textarea>
    <button type="submit">Send Hotel Alert</button>
</form>