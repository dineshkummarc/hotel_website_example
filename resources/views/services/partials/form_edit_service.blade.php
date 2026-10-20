<link rel="stylesheet" href="{{ asset('css/components/forms.css') }}">

<div class="update-form">
    <h3 class='title1'>Edit Service</h3>

    @if($errors->any())
    <div class="alert error">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('services.update', $service->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="name">Service Name</label>
        <input type="text" name="name" value="{{ $service->name }}" required>

        <label for="description">Description</label>
        <textarea name="description">{{ $service->description }}</textarea>

        <label for="price">Price ($)</label>
        <input type="number" step="0.01" name="price" value="{{ $service->price }}" min="0" required>

        <button class="show-btn" type="submit">Update Service</button>
    </form>
</div>