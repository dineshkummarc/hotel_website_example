<form action="{{ route('deleteUser', $user->id) }}" method="POST" style="display:inline;">
    @csrf
    <button type="submit" class="btn-delete">Delete</button>
</form>
