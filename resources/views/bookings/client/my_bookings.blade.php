    @extends('homepage.layouts.homepage')

    @push('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/booking.css') }}">
    <link rel="stylesheet" href="{{ asset('css/titles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pages/rooms.css') }}">
    @endpush


    @section('content')
    <h1 class="title2">My Bookings</h1>

    @include('bookings.partials.my_bookings')

    @include('bookings.partials.form_available_rooms')

    @if(!empty($checkIn) && !empty($checkOut))
    @include('bookings.partials.available_rooms_result', [
    'rooms' => $rooms,
    'checkIn' => $checkIn,
    'checkOut' => $checkOut
    ])
    @endif

    @endsection