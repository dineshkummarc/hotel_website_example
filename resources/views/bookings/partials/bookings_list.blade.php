<div class="booking-list-wrapper">
  <div class="booking-cards-container">
        @foreach($bookings as $booking)
            <div class="card booking-card booking-card-list">
                <p class="card-title">Room #{{ $booking->room_id }}</p>
                <p class="card-text">{{ $booking->user->name }}</p>
                <p class="card-text">Check-in: {{ $booking->check_in_date }}</p>
                <p class="card-text">Check-out: {{ $booking->check_out_date }}</p>
                <p class="card-text">Total Price: €{{ $booking->total_price }}</p>
            </div>
        @endforeach
    </div>
</div>