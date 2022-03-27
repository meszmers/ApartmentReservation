<?php

namespace App\Services\Reservation;

class CancelReservationRequest {
    private int $reservationId;

    public function __construct(int $reservationId)
    {

        $this->reservationId = $reservationId;
    }

    /**
     * @return int
     */
    public function getReservationId(): int
    {
        return $this->reservationId;
    }
}
