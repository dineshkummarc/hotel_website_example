 <div class="homepage-room-images">
    @foreach($images as $image)
        <img src="{{ asset('storage/' . $image->path) }}" alt="Room photo">
    @endforeach
</div>