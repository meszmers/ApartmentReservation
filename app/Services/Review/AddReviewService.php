<?php

namespace App\Services\Review;

use App\Repository\Review\PdoReviewRepository;
use App\Repository\Review\ReviewRepository;

class AddReviewService {
    private ReviewRepository $reviewRepository;

    public function __construct()
    {
        $this->reviewRepository = new PdoReviewRepository();
    }
    public function execute(AddReviewRequest $review) {
        $this->reviewRepository->review($review);
    }
}
