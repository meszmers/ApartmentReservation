<?php

namespace App\Services\Apartment;

use App\Repository\Apartment\ApartmentRepository;
use App\Repository\Apartment\PdoApartmentRepository;

class UpdateApartmentService {
    private ApartmentRepository $apartmentRepository;

    public function __construct()
    {
        $this->apartmentRepository = new PdoApartmentRepository();
    }

    public function execute(UpdateApartmentRequest $update): void {
        $this->apartmentRepository->update(new UpdateApartmentRequest(
            $update->getCountry(),
            $update->getAddress(),
            $update->getDescription(),
            $update->getRooms(),
            $update->getPrice(),
            $update->getApartmentId())
        );
    }
}