<?php

namespace App\Services\Apartment;

class UpdateApartmentRequest {
    private string $country;
    private string $address;
    private string $description;
    private int $rooms;
    private float $price;
    private int $apartmentId;


    public function __construct(string $country, string $address, string $description, int $rooms, float $price, int $apartmentId)
    {
        $this->country = $country;
        $this->address = $address;
        $this->description = $description;
        $this->rooms = $rooms;
        $this->price = $price;

        $this->apartmentId = $apartmentId;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @return int
     */
    public function getRooms(): int
    {
        return $this->rooms;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return int
     */
    public function getApartmentId(): int
    {
        return $this->apartmentId;
    }


}