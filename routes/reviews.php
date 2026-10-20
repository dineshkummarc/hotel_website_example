<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ReviewController;

//Show all reviews (Client)
Route::get(
    '/client/reviews',
    [ReviewController::class, 'showAllReviewsClient']
)
    ->name('reviews.client');

//Form New Review
Route::get(
    '/reviews/create',
    [ReviewController::class, 'formCreateReview']
)
    ->name('form.create.review');

//Create new review
Route::post(
    '/reviews',
    [ReviewController::class, 'createReview']
)
    ->name('create.review');

//Delete review
Route::delete(
    '/reviews/{id}',
    [ReviewController::class, 'destroy']
)
    ->name('delete.review');
