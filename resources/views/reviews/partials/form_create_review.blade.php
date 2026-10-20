<div class="form-wrapper create-form-review">

    <div class="form-group">
        <h2 class="title">Leave a review</h2>
    </div>

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

    <form action="{{ route('create.review') }}"
        method="POST"
        class="form">

        @csrf

        <div class="form-group">
            <label for="room_id">Choose your room</label>

            <select name="room_id" id="room_id" required>
                <option value="">-- Select Room --</option>

                @foreach($rooms as $room)
                <option value="{{ $room->id }}"
                    {{ old('room_id') == $room->id ? 'selected' : '' }}>
                    {{ $room->name }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="comment">Comment</label>

            <textarea
                name="comment"
                id="comment"
                rows="4"
                placeholder="Insert your comment">{{ old('comment') }}</textarea>
        </div>

        <div class="form-group">
            <label for="rating">Rating</label>

            <input
                type="number"
                name="rating"
                id="rating"
                min="1"
                max="5"
                value="{{ old('rating') }}"
                required>
        </div>

        <button class="btn-submit" type="submit">
            Submit Review
        </button>

    </form>
</div>