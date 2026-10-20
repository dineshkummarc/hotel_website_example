<?php

namespace App\Http\Controllers;

use App\Http\Services\RoomService;
use App\Models\Review;

class HomeController extends Controller
{
    protected $review;
    protected $roomService;

    public function __construct(Review $review, RoomService $roomService)
    {
        $this->review = $review;
        $this->roomService = $roomService;
    }

    public function index()
    {
        $reviews =  $this->review->limit(5)->get();

        $images = $this->roomService->getThreeImagesForHomepage();

        return view('homepage.index', compact('reviews', 'images'));
    }
}
