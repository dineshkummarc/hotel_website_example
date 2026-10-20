<?php

namespace App\Http\Controllers;

use App\Http\Services\ReviewService;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\FormRequestCreateReview;
use App\Models\Review;
use App\Models\User;

class ReviewController extends Controller
{
    protected ReviewService $reviewService;

    public function __construct(ReviewService $reviewService)
    {
        $this->reviewService = $reviewService;
    }

    // Show all reviews for the logged-in client
    public function showAllReviewsClient()
    {
        $reviews = $this->reviewService->getAll()->load('room');

        $user = Auth::user();

        /** @var User $user */
        $rooms = $user
            ->bookings()
            ->with('room')
            ->get()
            ->pluck('room')
            ->filter()
            ->unique('id');

        return view(
            'reviews.client.reviews',
            compact('reviews', 'rooms', 'user')
        );
    }

    // Form to create a review
    public function formCreateReview()
    {
        $user = Auth::user();

        /** @var User $user */
        $rooms = $user
            ->bookings()
            ->with('room')
            ->get()
            ->pluck('room')
            ->filter()
            ->unique('id');

        return view(
            'reviews.partials.form_create_review',
            compact('rooms')
        );
    }

    // Create a review
    public function createReview(FormRequestCreateReview $request)
    {
        $this->authorize('create', Review::class);

        $validated = $request->validated();

        $validated['user_id'] = Auth::id();

        $this->reviewService->create($validated);

        return redirect()
            ->back()
            ->with('success', 'Review created successfully!');
    }

    // Delete a review
    public function destroy($id)
    {
        $review = $this->reviewService->getById($id);

        if (!$review) {
            return redirect()
                ->back()
                ->with('fail', 'Review not found.');
        }

        $this->authorize('delete', $review);

        $this->reviewService->delete($id);

        return redirect()
            ->back()
            ->with('success', 'Review deleted successfully');
    }
}
