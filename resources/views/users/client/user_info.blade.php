@extends('homepage.layouts.homepage')

@section('title', 'Users Info')

@section('content')
<h3 class="title3"> Info User {{$user->name}}</h3>

@include('users.partials.user_info_partial', ['user' => $user])

@include('users.partials.update_user_form')

@endsection