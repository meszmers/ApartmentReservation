<?php
namespace App\Services\Review;


use App\Repository\Review\PdoReviewRepository;
use App\Repository\Review\ReviewRepository;

class GetAllReviewService {

    private ReviewRepository $reviewRepository;

    public function __construct()
    {
        $this->reviewRepository = new PdoReviewRepository();
    }

    public function execute(GetAllReviewRequest $apartmentId): array
    {
        return $this->reviewRepository->getAll($apartmentId);
    }
}