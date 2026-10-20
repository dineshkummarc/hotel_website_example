<link rel="stylesheet" href="{{ asset('css/components/buttons.css') }}">

<div class="services-list">
    <h3>Available Services</h3>

    @if($services->isEmpty())
    <p>No services found.</p>
    @else
    <ul>
        @foreach($services as $service)
        <li>
            <strong>{{ $service->name }}</strong> - ${{ number_format($service->price, 2) }}
            <p>{{ $service->description }}</p>

            <a href="{{ route('services.editForm', $service->id) }}">Edit</a>

            <form action="{{ route('services.destroy', $service->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-delete">Delete</button>
            </form>
        </li>
        @endforeach
    </ul>
    @endif
</div>