<?php

namespace App\Controllers;

use App\Database;
use App\Errors;
use App\Models\Reservation;
use App\Redirect;
use App\View;

class ReservationController
{

    public function userReservations()
    {
        $dataBase = Database::connection();
        $reservations = $dataBase->fetchAllAssociative('SELECT * FROM reservations WHERE user_id = ?', [$_SESSION["login"]["id"]]);
        $data = [];
        foreach ($reservations as $reservation) {
            $apartment = $dataBase->fetchAssociative('SELECT country, address, rooms  FROM apartments WHERE id = ?', [$reservation["apartment_id"]]);
            $data[] = new Reservation(
                $reservation["id"],
                $reservation["user_id"],
                $reservation["apartment_id"],
                $reservation["day_from"],
                $reservation["day_to"],
                $reservation["total_price"],
                $apartment["country"],
                $apartment["address"],
                $apartment["rooms"],);
        }

        return new View("Apartments/reservations.html", ["reservations" => $data]);
    }

    public function reserve($vars): Redirect
    {

        (new Errors())->bookingValidation($vars["id"], $_POST["from"], $_POST["to"]);

        if (empty($_SESSION["Errors"])) {
            $dataBase = Database::connection();
            $apartmentPrice = $dataBase->fetchAssociative('SELECT price FROM apartments WHERE id = ?', [$vars["id"]]);

            $price = number_format(count(range(str_replace("-", "", $_POST["from"]), str_replace("-", "", $_POST["to"]))) * $apartmentPrice["price"], 2);

            $dataBase->insert('reservations',
                [
                    "user_id" => $_SESSION["login"]["id"],
                    "apartment_id" => $vars["id"],
                    "day_from" => $_POST["from"],
                    "day_to" => $_POST["to"],
                    "total_price" => $price
                ]);
        }
        return new Redirect("/show/" . $vars["id"]);

    }

    public function cancel($vars): Redirect
    {

        Database::connection()
            ->delete('reservations', ['id' => $vars["id"]]);

        return new Redirect("/reservations");

    }
}