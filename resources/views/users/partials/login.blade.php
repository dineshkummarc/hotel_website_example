<div class="form-login-wrapper">
    <form class="form-login" action="{{ route('loginUser') }}" method="POST">
        @csrf

        <h3 class="title2">Login</h3>

        @if(session('error'))
        <div class="alert error">{{ session('error') }}</div>
        @endif

        <div class="form-login-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required placeholder="Insert your email">
        </div>

        <div class="form-login-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required placeholder="Insert your password">
        </div>

        <button type="submit" class="btn-submit">Enter</button>
    </form>
</div>