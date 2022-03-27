<?php

namespace App\Repository\Review;

use App\Database;
use App\Models\Review;
use App\Services\Review\AddReviewRequest;
use App\Services\Review\GetAllReviewRequest;
use Doctrine\DBAL\Exception;

class PdoReviewRepository implements ReviewRepository {

    public function getAll(GetAllReviewRequest $apartmentId): array
    {
        try {
            $db = Database::connection()->fetchAllAssociative('SELECT * FROM reviews WHERE apartment_id = ?', [$apartmentId->getApartmentId()]);
            $list = [];
            foreach ($db as $add) {
                $list[] = new Review($add["user_id"], $add["apartment_id"], $add["rating"], $add["review"], $add["created_at"]);
            }
            return $list;
        } catch (Exception $e) {
            echo "<pre>";
            echo $e;
            exit;
        }
    }
    public function review(AddReviewRequest $review): void
    {
        try {
            Database::connection()->insert('reviews', [
                "user_id" => $review->getUserId(),
                "apartment_id" => $review->getApartmentId(),
                "rating" => $review->getRating(),
                "review" => $review->getReview()
            ]);
        } catch (Exception $e) {
            echo "<pre>";
            echo $e;
            exit;
        }
    }
}