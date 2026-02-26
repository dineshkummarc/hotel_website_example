<div class="cards-wrapper">
    @if(isset($users) && $users->isEmpty())
        <p>No users found.</p>
    @else
        @foreach($users as $user)
            <div class="card">
                <p class="card-text"><strong>ID:</strong> {{ $user->id }}</p>
                <p class="card-text"><strong>Name:</strong> {{ $user->name }}</p>
                <p class="card-text"><strong>Email:</strong> {{ $user->email }}</p>
                @include('users.partials.user_delete', ['user' => $user])
            </div>
        @endforeach
    @endif
</div>