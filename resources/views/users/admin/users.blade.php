@extends('homepage.layouts.homepage')

@section('title', 'Users Admin')

@section('content')
<h1 class="title3">Users Management</h1>

@include('users.partials.register_admin_form')

@include('users.partials.user_search')

@include('users.partials.users_list')
@endsection
