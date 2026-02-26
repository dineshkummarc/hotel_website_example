@if(isset($user))
    @if($user)
        <div class="card">
            <h3 class="card-title">User <strong>{{ $user->name }}</strong></h3>
            <p class="card-text"><strong>ID:</strong> {{ $user->id }}</p>
            <p class="card-text"><strong>Name:</strong> {{ $user->name }}</p>
            <p class="card-text"><strong>Email:</strong> {{ $user->email }}</p>
        </div>

        <h3 class="card-title">{{ $user->name }}'s Bookings</h3>

        <div class="cards-wrapper">
            @foreach ($user->bookings as $booking)
                <div class="card">
                    <p class="card-text">Room: {{ $booking->room->name ?? 'N/A' }}</p>
                    <p class="card-text">Check-in: {{ $booking->check_in_date }}</p>
                    <p class="card-text">Check-out: {{ $booking->check_out_date }}</p>
                    <p class="card-text">Guests: {{ $booking->guest_count }}</p>
                    <p class="card-text">Total Price: €{{ $booking->total_price }}</p>
                    <p class="card-text">Status: {{ $booking->status }}</p>
                </div>
            @endforeach
        </div>
    @else
        <p style="color:red;">Utente non trovato.</p>
    @endif
@endif