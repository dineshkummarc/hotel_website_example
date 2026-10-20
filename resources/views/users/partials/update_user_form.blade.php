@if(isset($user))
<div class="form-login-wrapper">
    <h3 class="card-title2">Update User</h3>

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

    <form class="form-login" action="{{ route('updateUser', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-login-group">
            <label>Name:</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" required>
        </div>

        <div class="form-login-group">
            <label>Email:</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" required>
        </div>

        <div class="form-login-group">
            <label>Password:</label>
            <input type="password" name="password" placeholder="Insert old or new password">
        </div>

        <div class="form-login-group">
            <label>Confirm Password:</label>
            <input type="password" name="password_confirmation" placeholder="Confirm password">
        </div>

        @if(auth()->user()->role === 'admin')
        <div class="form-login-group role-selector">
            <label class="role-label">Role:</label>
            <input type="radio" id="client" name="role" value="client" checked>
            <label for="client" class="role-option">Client</label>

            <input type="radio" id="admin" name="role" value="admin">
            <label for="admin" class="role-option">Admin</label>
        </div>
        @endif

        <button class="btn-submit" type="submit">Update</button>
    </form>
</div>
@endif