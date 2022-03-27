<?php

namespace App\Services\Apartment;


use App\Repository\Apartment\ApartmentRepository;
use App\Repository\Apartment\PdoApartmentRepository;

class GetAllApartmentService {
    private ApartmentRepository $apartmentRepository;

    public function __construct()
    {
        $this->apartmentRepository = new PdoApartmentRepository();
    }

    public function execute(GetAllApartmentRequest $id): array {
       return $this->apartmentRepository->getAll($id);
    }
}