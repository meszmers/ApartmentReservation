<?php

namespace App\Repository\Apartment;

use App\Models\Apartment;

use App\Services\Apartment\DeleteApartmentRequest;
use App\Services\Apartment\GetAllApartmentRequest;
use App\Services\Apartment\ShowApartmentRequest;
use App\Services\Apartment\StoreApartmentRequest;
use App\Services\Apartment\UpdateApartmentRequest;

interface ApartmentRepository {

    public function save(StoreApartmentRequest $apartment): void;
    public function show(ShowApartmentRequest $apartmentId): Apartment;
    public function remove(DeleteApartmentRequest $id): void;
    public function update(UpdateApartmentRequest $update):void;
    public function getAll(GetAllApartmentRequest $id): array;

}