<?php
namespace App\Models;
class Review {

    private int $userId;
    private int $apartmentId;
    private int $rating;
    private string $review;
    private ?string $createdAt;
    private ?int $id;

    public function __construct(int $userId, int $apartmentId, int $rating, string $review, ?string $createdAt = null, ?int $id = null)
    {

        $this->userId = $userId;
        $this->apartmentId = $apartmentId;
        $this->rating = $rating;
        $this->review = $review;
        $this->createdAt = $createdAt;
        $this->id = $id;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getCreatedAt(): ?string
    {
        return $this->createdAt;
    }

    /**
     * @return int
     */
    public function getApartmentId(): int
    {
        return $this->apartmentId;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @return int
     */
    public function getRating(): int
    {
        return $this->rating;
    }

    /**
     * @return string
     */
    public function getReview(): string
    {
        return $this->review;
    }


}