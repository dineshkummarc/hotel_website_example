<div class="create-form-review">

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

    <form action="{{ route('create.review') }}" method="POST" class="review-form">
        @csrf

        <label for="room_id">Choose your room</label>
        <select name="room_id" id="room_id" required>
            <option value="">-- Select Room --</option>
            @foreach($rooms as $room)
                <option value="{{ $room->id }}">
                    {{ $room->name }}
                </option>
            @endforeach
        </select>

        <label for="comment">Comment</label>
        <textarea name="comment">{{ old('comment') }}</textarea>

        <label for="rating">Rating</label>
        <input type="number" name="rating" min="1" max="5" required>

        <button class="show-btn" type="submit">Submit Review</button>
    </form>
</div>
