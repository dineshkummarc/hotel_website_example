<ul class="menu-homepage">
    <li><a href="{{ route('homepage') }}">Homepage</a></li>

    <li>
        <a href="#">Sections ▾</a>
        <ul>
            <li><a href="{{ route('client.bookings.my') }}">My Bookings</a></li>
            <li><a href="{{ route('showAllRoomsClient') }}">Rooms</a></li>
            <li><a href="{{ route('reviews.client') }}">Reviews</a></li>
        </ul>
    </li>

    <li><a href="{{ route('client.bookings.index') }}">Book a Room</a></li>

    <li>
        <a href="#">Login ▾</a>
        <ul>
            <li><a href="{{ route('signInLogin') }}">Login</a></li>
            <li><a href="{{ route('signInLogin') }}">Sign Up</a></li>
            @auth
    @if(Auth::user())

    <li> <a href="{{ route('logout')}}">Logout</a></li>
    @endif
    @endauth
        </ul>
    </li>
    
   @auth
    @if(Auth::user()->role === 'admin')
        <li>
            <a href="#">Admin ▾</a>
            <ul>
                <li><a href="{{ route('showAllRoomsAdmin') }}">Manage Rooms</a></li>
                <li><a href="{{ route('admin.bookings.index') }}">Manage Bookings</a></li>
                <li><a href="{{ route('reviews.client') }}">Manage Reviews</a></li>
                <li><a href="{{ route('showAllUsers') }}">Manage Users</a></li>
            </ul>
        </li>
     @endif
    @endauth

    @auth
    @if(Auth::user())

    <li> <a href="{{ route('showUser')}}">Profile</a></li>
    @endif
    @endauth

</ul>
