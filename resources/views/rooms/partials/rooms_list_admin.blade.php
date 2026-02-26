
<div class="rooms-list"> 
  <h3 class="title2">Room List</h3>

  @if($rooms->isEmpty())
      <p>No rooms available.</p>
  @else
     
        @foreach($rooms as $room)
        <div class="room-card">
                <p class="room-name">{{ $room->name }}</p>
                <p class="room-price"> €{{ $room->price }} per night</p>
                
                <div class="room-photos">
                @foreach($room->images as $image)
                <img class="room-photo" src="{{ asset('storage/' . $image->path) }}" alt="Room photo">
                @endforeach
                </div>

                @include('rooms.partials.delete_room_button')
                @include('rooms.partials.update_room_button')
        </div>
        @endforeach
  @endif
</div>
