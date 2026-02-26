<div class="bookings">
    @foreach (Auth::user()->bookings as $booking)
        <div class="card booking-card">
            <p class="card-title">Room: {{ $booking->room->name ?? 'N/A' }}</p>
            <p class="card-text">Check-in: {{ $booking->check_in_date }}</p>
            <p class="card-text">Check-out: {{ $booking->check_out_date }}</p>
            <p class="card-text">Guests: {{ $booking->guest_count }}</p>
            <p class="card-text">Total Price: €{{ $booking->total_price }}</p>
            <p class="card-text">Status: {{ $booking->status }}</p>
        </div>
    @endforeach
</div>