   @extends('homepage.layouts.homepage')

    @push('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/homepage.css') }}">
   @endpush

   @section('content')

    @include('homepage.partials.room-images')

    @include('bookings.partials.form_available_rooms')

   @if(!empty($checkIn) && !empty($checkOut))
    @include('bookings.partials.available_rooms_result', [
        'rooms' => $rooms,
        'checkIn' => $checkIn,
        'checkOut' => $checkOut
    ])
@endif

    @include('reviews.partials.list_reviews')
   @endsection
