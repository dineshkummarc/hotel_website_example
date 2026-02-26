<?php

namespace App\Repositories;

use App\Models\Booking;
use Illuminate\Support\Facades\Cache;

class BookingRepository
{
    // Get bookings overlapping a date range
    public function getByDateRange($checkIn, $checkOut)
    {
        $key = "bookings_{$checkIn}_{$checkOut}";

        return Cache::remember($key, 600, function() use ($checkIn, $checkOut) {
            return Booking::with(['user', 'room'])
                ->where(function ($query) use ($checkIn, $checkOut) {
                    $query->where('check_in_date', '<=', $checkOut)
                          ->where('check_out_date', '>=', $checkIn);
                })
                ->get();
        });
    }
    // Check if a room is booked in a given interval
    public function existsOverlap($roomId, $checkIn, $checkOut)
    {
        return Booking::where('room_id', $roomId)
            ->where(function ($query) use ($checkIn, $checkOut) {
                $query->where('check_in_date', '<', $checkOut)
                      ->where('check_out_date', '>', $checkIn);
            })
            ->exists();
    }

    // Create a new booking
      public function createBooking($roomId, $userId, $checkIn, $checkOut, $guestCount, $totalPrice)
    {
        $booking = Booking::create([
            'room_id' => $roomId,
            'user_id' => $userId,
            'check_in_date' => $checkIn,
            'check_out_date' => $checkOut,
            'guest_count' => $guestCount,
            'total_price' => $totalPrice,
            'status' => 'pending',
        ]);

        Cache::forget("bookings_{$checkIn}_{$checkOut}");

        return $booking;
    }

    // Delete booking by ID
     public function deleteById($bookingId)
    {
        $booking = Booking::find($bookingId);
        if ($booking) {
            $key = "bookings_{$booking->check_in_date}_{$booking->check_out_date}";
            Cache::forget($key);
            return $booking->delete();
        }

        return false;
    }

    //show bookings by client id
     public function getBookingsByUserId($userId)
    {
        $key = "user_bookings_{$userId}";

        return Cache::remember($key, 600, function() use ($userId) {
            return Booking::with('room')
                          ->where('user_id', $userId)
                          ->get();
        });
    }
}
