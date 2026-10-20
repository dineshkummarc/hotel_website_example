<link rel="stylesheet" href="{{ asset('css/pages/rooms.css') }}">
<link rel="stylesheet" href="{{ asset('css/pages/booking.css') }}">
@extends('homepage.layouts.homepage')

@section('title', 'Available Rooms')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/pages/rooms.css') }}">
@endpush

@section('content')

<h3 class="title3">Room Management</h3>
@include('rooms.partials.create_room_form')

@if(isset($roomToEdit))
@include('rooms.partials.update_room_form', ['room' => $roomToEdit])
@endif

@include('rooms.partials.rooms_list_admin', ['rooms' => $rooms])



@endsection