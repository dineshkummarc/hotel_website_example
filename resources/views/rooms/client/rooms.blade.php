<link rel="stylesheet" href="{{ asset('css/pages/rooms.css') }}">
<link rel="stylesheet" href="{{ asset('css/pages/booking.css') }}">

@extends('homepage.layouts.homepage')

@section('title', 'Available Rooms')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/pages/rooms.css') }}">
@endpush

@section('content')

<h2 class="title2" style="text-align:center;">Available Rooms</h2>

@include('rooms.partials.rooms_list_client', ['rooms' => $rooms])

@endsection