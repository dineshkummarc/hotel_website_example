<div class="bookings">
    @foreach (Auth::user()->bookings as $booking)
    <div class="card booking-card">
        <p class="card-title"><strong>Room:</strong> {{ $booking->room->name ?? 'N/A' }}</p>
        <p class="card-text"><strong>Check-in:</strong> {{ $booking->check_in_date }}</p>
        <p class="card-text"><strong>Check-out:</strong> {{ $booking->check_out_date }}</p>
        <p class="card-text"><strong>Guests:</strong> {{ $booking->guest_count }}</p>
        <p class="card-text"><strong>Total Price:</strong> €{{ $booking->total_price }}</p>
        <p class="card-text"><strong>Status:</strong> {{ $booking->status }}</p>
    </div>
    @endforeach
</div>