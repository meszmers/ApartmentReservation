<?php


namespace App\Services\Reservation;

use App\Repository\Reservation\PdoReservationRepository;
use App\Repository\Reservation\ReservationRepository;


class CancelReservationService {

    private ReservationRepository $reservationRepository;

    public function __construct()
    {
        $this->reservationRepository = new PdoReservationRepository();
    }

    public function execute(CancelReservationRequest $id): void {
        $this->reservationRepository->cancel($id);
    }
}