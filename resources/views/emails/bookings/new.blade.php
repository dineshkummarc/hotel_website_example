<x-mail::message>
# New Booking

Room: {{ $booking->room->name }}
User: {{ $booking->user->name }}
Check-in: {{ $booking->check_in_date }}
Check-out: {{ $booking->check_out_date }}
Guests: {{ $booking->guest_count }}
Total Price: ${{ $booking->total_price }}

<x-mail::button :url="''">
Button Text
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
