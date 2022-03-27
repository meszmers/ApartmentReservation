<?php

namespace App\Repository\Reservation;


use App\Services\Reservation\AddReservationRequest;
use App\Services\Reservation\CancelReservationRequest;
use App\Services\Reservation\GetAllByApartmentReservationRequest;
use App\Services\Reservation\GetAllByUserReservationRequest;

interface ReservationRepository {


    public function getAllByApartment(GetAllByApartmentReservationRequest $id): array;
    public function getAllByUser(GetAllByUserReservationRequest $id): array;
    public function reserve(AddReservationRequest $reservation): void;
    public function cancel(CancelReservationRequest $id): void;

}