<h3 class="title2">Show Bookings in a Period</h3>

<div class="form-wrapper">
    <form class="form" method="GET" action="{{ route(
        request()->routeIs('admin.*') 
            ? 'admin.bookings.show'
            : 'client.bookings.show'
    ) }}">

        <div class="form-group">
            <label>From</label>
            <input type="date" name="check_in" required>
        </div>

        <div class="form-group">
            <label>To</label>
            <input type="date" name="check_out" required>
        </div>

        <button class="btn-submit">Show Bookings</button>
    </form>
</div>