<div class="form-login-wrapper">
    <h3 class="card-title">New User</h3>

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
        <div class="alert success">
            {{ session('success') }}
        </div>
    @endif

    <form class="form-login" action="{{ route('signInUser') }}" method="POST">
        @csrf

        <div class="form-login-group">
            <label for="name">Name:</label>
            <input type="text" name="name" required>
        </div>

        <div class="form-login-group">
            <label for="email">Email:</label>
            <input type="email" name="email" required>
        </div>

        <div class="form-login-group">
            <label for="password">Password:</label>
            <input type="password" name="password" required>
        </div>

        <div class="form-login-group">
            <label>Confirm Password:</label>
            <input type="password" name="password_confirmation" placeholder="Confirm password">
        </div>

        <div class="form-login-group">
    <label class="role-label">Role:</label>
    <div class="role-selector">
        <input type="radio" id="client" name="role" value="client" checked>
        <label for="client" class="role-option">Client</label>

        <input type="radio" id="admin" name="role" value="admin">
        <label for="admin" class="role-option">Admin</label>
    </div>
</div>
        <button class="btn-submit" type="submit">Create User</button>
    </form>
</div>