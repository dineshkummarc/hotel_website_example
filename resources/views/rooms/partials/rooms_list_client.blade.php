@if($rooms->isEmpty())
    <p>No rooms available.</p>
@else
    <div class="rooms-list">
        @foreach($rooms as $room)
            <div class="room-card">
                <h4 class="room-name">{{ $room->name }}</h4>
                <p class="room-description">{{ $room->description }}</p>

                <div class="room-info">
                    <p class="room-guests">Guests: {{ $room->guests }}</p>
                    <p class="room-price">Price: €{{ $room->price }}</p>
                </div>

                <div class="room-photos">
                    @foreach($room->images as $image)
                <img src="{{ asset('storage/' . $image->path) }}" alt="Room photo">
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
@endif