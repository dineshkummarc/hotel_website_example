<div class="form-login-wrapper">
    <h3 class="card-title2">Search User by ID</h3>
    <form class="form-login" action="{{ route('showUser') }}" method="POST">
        @csrf
        <div class="form-login-group">
            <label for="user_id">User ID:</label>
            <input type="number" name="user_id" required>
        </div>
        <button class="btn-submit" type="submit">Search</button>
    </form>
</div>