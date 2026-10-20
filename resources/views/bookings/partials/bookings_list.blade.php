<div class="booking-list-wrapper">
    <div class="booking-cards-container">
        @foreach($bookings as $booking)
        <div class="card booking-card booking-card-list">
            <p class="card-title"><strong>Room</strong> #{{ $booking->room_id }}</p>
            <p class="card-text">{{ $booking->user->name }}</p>
            <p class="card-text"><strong>Check-in:</strong> {{ $booking->check_in_date }}</p>
            <p class="card-text"><strong>Check-out:</strong> {{ $booking->check_out_date }}</p>
            <p class="card-text"><strong>Total Price:</strong> €{{ $booking->total_price }}</p>
        </div>
        @endforeach
    </div>
</div>