@extends('homepage.layouts.homepage')

   @push('styles')
   <link rel="stylesheet" href="{{ asset('css/admin/bookings.css') }}">
   @endpush

@section('content')
    <h1 class="title2">Hotel Bookings</h1>

    @include('bookings.partials.form_available_rooms')

    @if(!empty($checkIn) && !empty($checkOut))
    @include('bookings.partials.available_rooms_result', [
        'rooms' => $rooms,
        'checkIn' => $checkIn,
        'checkOut' => $checkOut
    ])
    @endif
    
@endsection
