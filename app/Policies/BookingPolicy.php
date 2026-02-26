<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Booking;

class BookingPolicy
{
    public function view(User $user, Booking $booking)
    {
        return $user->role === 'admin' || $user->id === $booking->user_id;
    }

    public function delete(User $user, Booking $booking)
    {
        return $user->role === 'admin' || $user->id === $booking->user_id;
    }
}