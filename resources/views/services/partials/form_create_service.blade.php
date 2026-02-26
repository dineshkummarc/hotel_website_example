<link rel="stylesheet" href="{{ asset('css/forms.css') }}">
<link rel="stylesheet" href="{{ asset('css/buttons.css') }}">

<div class="create-form">
    <h3>Create a New Service</h3>

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

    <form action="{{ route('services.create') }}" method="POST">
        @csrf

        <label for="name">Service Name</label>
        <input type="text" name="name" value="{{ old('name') }}" required>

        <label for="description">Description</label>
        <textarea name="description">{{ old('description') }}</textarea>

        <label for="price">Price ($)</label>
        <input type="number" step="0.01" name="price" value="{{ old('price') }}" min="0" required>

        <button class="show-btn" type="submit">Create Service</button>
    </form>
</div>
