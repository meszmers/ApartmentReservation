<?php

namespace App\Services\Reservation;

class AddReservationRequest {
    private int $userId;
    private int $apartmentId;
    private string $dayFrom;
    private string $dayTo;
    private float $totalPrice;

    public function __construct(int $userId, int $apartmentId, string $dayFrom, string $dayTo, float $totalPrice)
    {
        $this->userId = $userId;
        $this->apartmentId = $apartmentId;
        $this->dayFrom = $dayFrom;
        $this->dayTo = $dayTo;
        $this->totalPrice = $totalPrice;
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
     * @return float
     */
    public function getTotalPrice(): float
    {
        return $this->totalPrice;
    }

    /**
     * @return string
     */
    public function getDayTo(): string
    {
        return $this->dayTo;
    }

    /**
     * @return string
     */
    public function getDayFrom(): string
    {
        return $this->dayFrom;
    }
}