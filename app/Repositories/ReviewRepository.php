<?php

namespace App\Repositories;

use App\Models\Review;
use Illuminate\Support\Facades\Cache;

class ReviewRepository
{
    // Get all reviews
    public function getAll()
    {
        $key = 'cache_reviews';

        return Cache::remember($key, 600, function () {
            return Review::with(['user', 'room'])->get();
        });
    }

    // Get a review by ID
    public function getById($id)
    {
        return Review::with(['user', 'room'])->find($id);
    }

    // Create a new review
    public function create($data)
    {
        $review = Review::create($data);

        Cache::forget('cache_reviews');

        return $review;
    }

    // Delete a review
    public function delete($id)
    {
        $deleted = Review::destroy($id);

        Cache::forget('cache_reviews');

        return $deleted;;
    }
}
