<?php

namespace App\Services\Apartment;

class GetAllApartmentRequest {


    private ?int $id;

    public function __construct(?int $id = null)
    {

        $this->id = $id;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }



}