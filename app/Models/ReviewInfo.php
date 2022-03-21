<?php
namespace App\Models;
class ReviewInfo {
    private int $id;
    private int $userId;
    private int $apartmentId;
    private int $rating;
    private string $review;
    private string $name;
    private string $surname;
    private string $createdAt;

    public function __construct(int $id, int $userId, int $apartmentId, int $rating, string $review, string $name, string $surname, string $createdAt)
    {
        $this->id = $id;
        $this->userId = $userId;
        $this->apartmentId = $apartmentId;
        $this->rating = $rating;
        $this->review = $review;
        $this->name = $name;
        $this->surname = $surname;
        $this->createdAt = $createdAt;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
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
     * @return string
     */
    public function getSurname(): string
    {
        return $this->surname;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
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