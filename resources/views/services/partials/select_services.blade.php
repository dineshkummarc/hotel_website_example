<div class="services-list">
    <h4>Select Additional Services</h4>

    @if($services->isEmpty())
    <p>No additional services available.</p>
    @else
    @foreach($services as $service)
    <div class="service-option">
        <input type="checkbox" name="services[]" value="{{ $service->id }}" id="service_{{ $service->id }}">
        <label for="service_{{ $service->id }}">
            {{ $service->name }} - ${{ number_format($service->price, 2) }}
        </label>
    </div>
    @endforeach
    @endif
</div>