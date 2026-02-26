<?php

namespace App\Policies;

use App\Models\Review;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ReviewPolicy
{
    public function delete(User $user, Review $review)
    {
        return $user->role === 'admin' || $user->id === $review->user_id;
    }

    public function create(User $user)
    {
        return $user->role !== null; 
    }
}
