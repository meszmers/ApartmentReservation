<?php

namespace App\Services\Reservation;


use App\Repository\Reservation\PdoReservationRepository;
use App\Repository\Reservation\ReservationRepository;



class GetAllByApartmentReservationService {


    private ReservationRepository $reservationRepository;

    public function __construct()
    {
        $this->reservationRepository = new PdoReservationRepository();
    }

    public function execute(GetAllByApartmentReservationRequest $id): array {
      return $this->reservationRepository->getAllByApartment($id);
    }
}
