<h3 class="title2">Delete Booking</h3>

<div class="form-wrapper">
    <form class="form" method="POST" action="{{ route(
        request()->routeIs('admin.*') 
            ? 'admin.bookings.delete'
            : 'client.bookings.delete'
    ) }}">
        @csrf

        <div class="form-group">
            <label>Booking ID</label>
            <input type="number" name="booking_id" required>
        </div>

        <button class="btn-submit">Delete</button>
    </form>
</div>