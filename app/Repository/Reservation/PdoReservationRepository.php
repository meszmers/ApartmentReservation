<?php

namespace App\Repository\Reservation;

use App\Database;
use App\Models\Reservation;
use App\Services\Reservation\AddReservationRequest;
use App\Services\Reservation\CancelReservationRequest;
use App\Services\Reservation\GetAllByApartmentReservationRequest;
use App\Services\Reservation\GetAllByUserReservationRequest;
use Doctrine\DBAL\Exception;

class PdoReservationRepository implements ReservationRepository {


    public function getAllByApartment(GetAllByApartmentReservationRequest $id): array
    {
        try {

            $db = Database::connection()->fetchAllAssociative('SELECT * FROM reservations WHERE apartment_id = ?', [$id->getApartmentId()]);

            $list = [];
            foreach ($db as $add) {
                $list[] = new Reservation(
                    $add["id"],
                    $add["user_id"],
                    $add["apartment_id"],
                    $add["day_from"],
                    $add["day_to"],
                    $add["total_price"]
                );
            }
            return $list;

        } catch(Exception $e) {
            echo "<pre>";
            echo $e;
            exit;
        }
    }

    public function getAllByUser(GetAllByUserReservationRequest $id): array
    {
        try {

            $db = Database::connection()->fetchAllAssociative('SELECT * FROM reservations WHERE user_id = ?', [$id->getUserId()]);


            $list = [];
            foreach ($db as $add) {
                $list[] = new Reservation(
                    $add["id"],
                    $add["user_id"],
                    $add["apartment_id"],
                    $add["day_from"],
                    $add["day_to"],
                    $add["total_price"],
                );
            }

            return $list;

        } catch(Exception $e) {
            echo "<pre>";
            echo $e;
            exit;
        }
    }
    public function reserve(AddReservationRequest $reservation): void {
        try {
            Database::connection()->insert('reservations',
                [
                    "user_id" => $reservation->getUserId(),
                    "apartment_id" => $reservation->getApartmentId(),
                    "day_from" => $reservation->getDayFrom(),
                    "day_to" => $reservation->getDayTo(),
                    "total_price" => $reservation->getTotalPrice()
                ]);
        } catch (Exception $e) {
            echo "<pre>";
            echo $e;
            exit;
        }
    }

    public function cancel(CancelReservationRequest $id): void {
        try {
        Database::connection()->delete('reservations', ['id' => $id->getReservationId()]);
        } catch (Exception $e) {
            echo "<pre>";
            echo $e;
            exit;
        }
    }


}
