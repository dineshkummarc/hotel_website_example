<h3 class="title2">Create New Booking</h3>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="form-wrapper">
    @php
        $formAction = request()->routeIs('admin.*') 
            ? route('admin.bookings.create')
            : route('client.bookings.create');
    @endphp

    <form method="POST" action="{{ $formAction }}" class="form">
        @csrf

        @auth
        @if(auth()->user()->role === 'admin')
        <div class="form-group">
            <label for="user_id">Client ID:</label>
            <input type="number" name="user_id" id="user_id" required>
        </div>
        @endif
        @endauth

        <div class="form-group">
            <label for="room_id">Room:</label>
            <select name="room_id" id="room_id" required>
                @foreach($rooms as $room)
                    <option value="{{ $room->id }}">
                        {{ $room->name }} (max {{ $room->guests }} guests)
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="check_in">Check-in:</label>
            <input type="date" name="check_in" id="check_in" required>
        </div>

        <div class="form-group">
            <label for="check_out">Check-out:</label>
            <input type="date" name="check_out" id="check_out" required>
        </div>

        <div class="form-group">
            <label for="guest_count">Guests</label>
            <input type="number" name="guest_count" id="guest_count" min="1" required>
        </div>

        <button class="btn-submit" type="submit">Create Booking</button>
    </form>
</div>