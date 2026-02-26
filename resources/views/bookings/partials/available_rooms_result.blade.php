<div class="room-list-wrapper-booking">
    @foreach($rooms as $room)
        <div class="card room-card-booking">
            <h4 class="card-title room-name-booking">{{ $room->name }}</h4>
            <p class="card-text price-booking">Price per night: €{{ $room->price }}</p>
            <p class="card-text price-total-booking">Total for stay: <strong>€{{ $room->total_price }}</strong></p>

            <div class="room-photos">
                @foreach($room->images as $image)
                    <img src="{{ asset('storage/' . $image->path) }}" alt="Room photo">
                @endforeach
            </div>
            
            <form class="form" method="POST" action="{{ route('client.bookings.create') }}">
                @csrf
                <input type="hidden" name="room_id" value="{{ $room->id }}">
                <input type="hidden" name="check_in" value="{{ $checkIn ?? '' }}">
                <input type="hidden" name="check_out" value="{{ $checkOut ?? '' }}">
                <input type="hidden" name="guest_count" value="1">

                <button class="btn-submit" type="submit">Book</button>
            </form>
        </div>
    @endforeach
</div>