<?php
namespace App\Services\Apartment;

use App\Repository\Apartment\ApartmentRepository;
use App\Repository\Apartment\PdoApartmentRepository;

class StoreApartmentService {


    private ApartmentRepository $apartmentRepository;

    public function __construct()
    {
        $this->apartmentRepository = new PdoApartmentRepository();
    }

    public function execute(StoreApartmentRequest $obj): void
    {
        $this->apartmentRepository->save(new StoreApartmentRequest(
            $obj->getCreatedUserId(),
            $obj->getCountry(),
            $obj->getAddress(),
            $obj->getDescription(),
            $obj->getRooms(),
            $obj->getAvailableFrom(),
            $obj->getAvailableTo(),
            $obj->getPrice(),
            $obj->getPicture()
        ));
    }
}