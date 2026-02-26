<link rel="stylesheet" href="{{ asset('css/buttons.css') }}">

<form action="{{ route('deleteRoom') }}" method="POST" style="display:inline;">
    @csrf
    <input type="hidden" name="id" value="{{ $room->id }}">
    <button type="submit" class="btn-delete" onclick="return confirm('Are you sure you want to delete this room?')">
        Delete
    </button>
</form>
