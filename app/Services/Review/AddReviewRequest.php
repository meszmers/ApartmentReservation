<?php

namespace App\Services\Review;

class AddReviewRequest {
    private $userId;
    private $apartmentId;
    private $rating;
    private $review;

    public function __construct($userId, $apartmentId, $rating, $review)
    {
        $this->userId = $userId;
        $this->apartmentId = $apartmentId;
        $this->rating = $rating;
        $this->review = $review;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @return mixed
     */
    public function getApartmentId()
    {
        return $this->apartmentId;
    }

    /**
     * @return mixed
     */
    public function getReview()
    {
        return $this->review;
    }

    /**
     * @return mixed
     */
    public function getRating()
    {
        return $this->rating;
    }

}
