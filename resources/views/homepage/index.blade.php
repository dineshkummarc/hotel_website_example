   @extends('homepage.layouts.homepage')

   @push('styles')
   <link rel="stylesheet" href="{{ asset('css/pages/homepage.css') }}">
   @endpush

   @section('content')
   <div class="description">
       <p>Hotel Luce is a welcoming and comfortable hotel located in a strategic area, offering easy access to the main attractions and points of interest nearby.</br>
           With well-appointed rooms, modern amenities, and attentive service, the hotel provides an ideal setting for both leisure and business travelers. </br>
           Guests can enjoy a relaxing atmosphere and a pleasant stay tailored to their needs.
       </p>
   </div>
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