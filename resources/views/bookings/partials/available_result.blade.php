<link rel="stylesheet" href="{{ asset('css/forms.css') }}">

@if(isset($available))
    <div class="card result-1">
        <h3 class="card-title">Availability Result</h3>
        <p class="card-text">Room: {{ $room->name }}</p>
        <p class="card-text">From: {{ $checkIn }} To: {{ $checkOut }}</p>
        <strong class="card-text">
            {{ $available ? 'Available' : 'Occupied' }}
        </strong>
    </div>
@endif