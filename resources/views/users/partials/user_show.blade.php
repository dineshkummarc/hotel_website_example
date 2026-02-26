@if(isset($user))
    @if($user)
        <div class="users-list">
            <h3>Dettagli Utente <strong>{{ $user->nome }}</strong></h3>
            <p><strong>ID:</strong> {{ $user->id }}</p>
            <p><strong>Nome:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
        </div>
    @else
        <p style="color:red;">Utente non trovato.</p>
    @endif
@endif
