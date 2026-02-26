<h3 class="title2">Check Room Availability</h3>

<div class="form-wrapper">
    <form class="form" action="{{ route('checkAvailability') }}" method="GET">

        <div class="form-group">
            <label>Room</label>
            <select name="room_id" required>
                @foreach($rooms as $room)
                    <option value="{{ $room->id }}">{{ $room->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Check-in</label>
            <input type="date" name="check_in" required>
        </div>

        <div class="form-group">
            <label>Check-out</label>
            <input type="date" name="check_out" required>
        </div>

        <button class="btn-submit" type="submit">Check</button>
    </form>
</div>