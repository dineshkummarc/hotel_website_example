<?php

namespace App\Http\Services;

use App\Repositories\ReviewRepository;

class ReviewService
{
    protected ReviewRepository $reviewRepository;

    public function __construct(ReviewRepository $reviewRepository)
    {
        $this->reviewRepository = $reviewRepository;
    }

    public function getAll()
    {
        return $this->reviewRepository->getAll();
    }

    public function getById($id)
    {
        return $this->reviewRepository->getById($id);
    }

    public function create($data)
    {
        return $this->reviewRepository->create($data);
    }

    public function delete($id)
    {
        return $this->reviewRepository->delete($id);
    }
}
