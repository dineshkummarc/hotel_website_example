
@extends('homepage.layouts.homepage')

   @push('styles')
   <link rel="stylesheet" href="{{ asset('css/pages/booking.css') }}">>
   @endpush


@section('content')
    <h1 class="title3">Hotel Booking Management</h1>

    {{-- Form to show all bookings --}}
    @include('bookings.partials.form_show_bookings')

     {{-- List of bookings --}}
   @include('bookings.partials.bookings_list', ['bookings' => $bookings])
    
    {{-- Form to create a booking --}}
    @include('bookings.partials.form_create_booking')

    {{-- Form to delete a booking --}}
    @include('bookings.partials.form_delete_booking')

    {{-- Form to check room availability --}}
    @include('bookings.partials.form_available_rooms')

    {{-- Availability result --}}
    @if(!empty($checkIn) && !empty($checkOut))
    @include('bookings.partials.available_rooms_result', [
        'rooms' => $rooms,
        'checkIn' => $checkIn,
        'checkOut' => $checkOut
    ])
    @endif

@endsection

