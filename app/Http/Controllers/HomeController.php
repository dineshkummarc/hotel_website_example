<?php

namespace App\Http\Controllers;

use App\Http\Services\ReviewService;
use App\Http\Services\RoomService;

class HomeController extends Controller
{
    protected $reviewService;
    protected $roomService;

    public function __construct(ReviewService $reviewService, RoomService $roomService)
    {
        $this->reviewService = $reviewService;
        $this->roomService = $roomService;
    }

    public function index() 
    { 
        $reviews = $this->reviewService->getAll()->take(5);

        $images = $this->roomService->getThreeImagesForHomepage();

    return view('homepage.index', compact('reviews', 'images'));
    }
}
