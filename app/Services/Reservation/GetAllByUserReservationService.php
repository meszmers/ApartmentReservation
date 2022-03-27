<?php

namespace App\Services\Reservation;


use App\Repository\Reservation\PdoReservationRepository;
use App\Repository\Reservation\ReservationRepository;

class GetAllByUserReservationService {

    private ReservationRepository $reservationRepository;

    public function __construct()
    {
        $this->reservationRepository = new PdoReservationRepository();
    }

    public function execute(GetAllByUserReservationRequest $id): array {

       return $this->reservationRepository->getAllByUser($id);
    }
}
