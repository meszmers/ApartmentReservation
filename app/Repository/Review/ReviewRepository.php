<?php

namespace App\Repository\Review;

use App\Services\Review\AddReviewRequest;
use App\Services\Review\GetAllReviewRequest;

interface ReviewRepository {
    public function getAll(GetAllReviewRequest $apartmentId): array;
    public function review(AddReviewRequest $review): void;
}