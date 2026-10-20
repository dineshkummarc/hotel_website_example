<h3 class="title2">Create a New Room</h3>

<div class="form-wrapper">

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

    <form action="{{ route('createNewRoom') }}"
        method="POST"
        enctype="multipart/form-data"
        class="form">

        @csrf

        <div class="form-group">
            <label>Room Name</label>
            <input type="text" name="name" value="{{ old('name') }}" required placeholder="Insert room name">
        </div>

        <div class="form-group">
            <label>Description</label>
            <textarea name="description" required placeholder="Insert room description">{{ old('description') }}</textarea>
        </div>

        <div class="form-group">
            <label>Guests</label>
            <input type="number" name="guests" min="1" max="10" required>
        </div>

        <div class="form-group">
            <label>Price (€)</label>
            <input type="number" step="0.01" name="price" min="0" required>
        </div>

        <div class="form-group">
            <label>Available</label>
            <select name="available" required>
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
        </div>

        <div class="form-group">
            <label for="images" class="btn-submit">📸 Upload Images</label>
            <input type="file" id="images" name="images[]" multiple hidden>
        </div>

        <button type="submit"
            class="btn-submit"
            onclick="return confirm('Are you sure you want to create this room?')">
            Create
        </button>
    </form>
</div>