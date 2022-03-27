<?php

namespace App\Services\Reservation;

use App\Repository\Reservation\PdoReservationRepository;
use App\Repository\Reservation\ReservationRepository;

class AddReservationService {
    private ReservationRepository $reservationRepository;

    public function __construct()
    {
        $this->reservationRepository = new PdoReservationRepository();
    }
    public function execute(AddReservationRequest $reservation): void {
        $this->reservationRepository->reserve($reservation);
    }
}