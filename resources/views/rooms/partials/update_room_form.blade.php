<h4 class="title2">Update Room</h4>

<div class="form-wrapper">

    @if($errors->any())
        <div class="alert error">
            <ol>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ol>
        </div>
    @endif

    <form action="{{ route('updateRoom', $room->id) }}"
          method="POST"
          enctype="multipart/form-data"
          class="form">

        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Room Name</label>
            <input type="text" name="name"
                   value="{{ old('name', $room->name) }}" required>
        </div>

        <div class="form-group">
            <label>Description</label>
            <textarea name="description">{{ old('description', $room->description) }}</textarea>
        </div>

        <div class="form-group">
            <label>Guests</label>
            <input type="number" name="guests"
                   value="{{ old('guests', $room->guests) }}"
                   min="1" max="10" required>
        </div>

        <div class="form-group">
            <label>Price (€)</label>
            <input type="number" name="price"
                   value="{{ old('price', $room->price) }}"
                   min="0" step="0.01" required>
        </div>

        <div class="form-group">
            <label>Available</label>
            <select name="available" required>
                <option value="1" {{ old('available', $room->available) == 1 ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ old('available', $room->available) == 0 ? 'selected' : '' }}>No</option>
            </select>
        </div>

        <div class="form-group">
            <label for="images" class="custom-upload">📸 Upload Images</label>
            <input type="file" id="images" name="images[]" multiple hidden>
        </div>

        <button type="submit" class="btn-submit">Update Room</button>
    </form>
</div>