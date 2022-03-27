<?php

namespace App\Services\Apartment;


use App\Repository\Apartment\ApartmentRepository;
use App\Repository\Apartment\PdoApartmentRepository;

class DeleteApartmentService {
    private ApartmentRepository $apartmentRepository;

    public function __construct()
    {
        $this->apartmentRepository = new PdoApartmentRepository();
    }
    public function execute(DeleteApartmentRequest $id): void {
        $this->apartmentRepository->remove($id);
    }
}