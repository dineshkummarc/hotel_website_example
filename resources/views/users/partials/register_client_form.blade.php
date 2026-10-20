<div class="form-login-wrapper">
    <form class="form-login" action="{{ route('signInUser') }}" method="POST">
        @csrf

        <h3 class="title2">New User</h3>

        @if($errors->any())
        <div class="alert error">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @if(session('success'))
        <div class="alert success">{{ session('success') }}</div>
        @endif

        <div class="form-login-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required placeholder="Insert your surname and your name">
        </div>

        <div class="form-login-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required placeholder="Insert your email">
        </div>

        <div class="form-login-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required placeholder="Insert password">
        </div>

        <div class="form-login-group">
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm password">
        </div>

        <button type="submit" class="btn-submit">Sign In</button>
    </form>
</div>