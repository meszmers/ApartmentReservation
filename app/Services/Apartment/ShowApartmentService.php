<?php

namespace App\Services\Apartment;

use App\Models\Apartment;
use App\Repository\Apartment\ApartmentRepository;
use App\Repository\Apartment\PdoApartmentRepository;

class ShowApartmentService {

    private ApartmentRepository $apartmentRepository;

    public function __construct()
    {
        $this->apartmentRepository = new PdoApartmentRepository();
    }

    public function execute(ShowApartmentRequest $id): Apartment
    {

       return $this->apartmentRepository->show($id);
    }
}