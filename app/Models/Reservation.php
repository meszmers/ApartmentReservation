<?php

namespace App\Models;
class Reservation
{


    private int $userId;
    private int $apartmentId;
    private string $dayFrom;
    private string $dayTo;
    private float $totalPrice;
    private ?int $id;

    public function __construct(int $id, int $userId, int $apartmentId, string $dayFrom, string $dayTo, float $totalPrice)
    {

        $this->userId = $userId;
        $this->apartmentId = $apartmentId;
        $this->dayFrom = $dayFrom;
        $this->dayTo = $dayTo;
        $this->totalPrice = $totalPrice;
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
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @return int
     */
    public function getApartmentId(): int
    {
        return $this->apartmentId;
    }

    /**
     * @return string
     */
    public function getDayFrom(): string
    {
        return $this->dayFrom;
    }

    /**
     * @return string
     */
    public function getDayTo(): string
    {
        return $this->dayTo;
    }

    /**
     * @return float
     */
    public function getTotalPrice(): float
    {
        return $this->totalPrice;
    }


}