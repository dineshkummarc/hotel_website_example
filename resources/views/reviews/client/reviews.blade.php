
@extends('homepage.layouts.homepage')

@section('title', 'Reviews client')

@section('content')
@auth
    @if($user->role!=='admin')
     <h2 class="title2">Leave a Review</h2>
    @include('reviews.partials.form_create_review', ['rooms' => $rooms])
    @endif
@endauth
@include('reviews.partials.list_reviews')

@endsection
