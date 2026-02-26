<h3 class="title2">Check rooms available</h3>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="form-wrapper">
    <form class="form" action="{{ route(
        request()->routeIs('admin.*') 
            ? 'admin.bookings.available'
            : 'client.bookings.available'
    ) }}" method="GET">

        <div class="form-group">
            <label for="check_in">CHECK-IN</label>
            <input type="date" name="check_in" required>
        </div>

        <div class="form-group">
            <label for="check_out">CHECK-OUT</label>
            <input type="date" name="check_out" required>
        </div>

        <button class="btn-submit" type="submit">CHECK</button>
    </form>
</div>