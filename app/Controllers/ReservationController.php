<?php

namespace App\Controllers;

use App\Errors;
use App\Redirect;
use App\Services\Apartment\ShowApartmentRequest;
use App\Services\Apartment\ShowApartmentService;
use App\Services\Reservation\AddReservationRequest;
use App\Services\Reservation\AddReservationService;
use App\Services\Reservation\CancelReservationRequest;
use App\Services\Reservation\CancelReservationService;
use App\Services\Reservation\GetAllByUserReservationRequest;
use App\Services\Reservation\GetAllByUserReservationService;
use App\View;

class ReservationController
{

    public function userReservations(): View
    {
        $reservations = (new GetAllByUserReservationService())->execute(new GetAllByUserReservationRequest((int)$_SESSION["login"]["id"]));
        $data = [];

        foreach ($reservations as $reservation) {
            $apartment = (new ShowApartmentService())->execute(new ShowApartmentRequest($reservation->getApartmentId()));
            $data[] = ["reservation" => $reservation, "apartment" => $apartment];
        }

        return new View("Apartments/reservations.html", ["reservations" => $data]);
    }


    public function reserve($vars): Redirect
    {
        (new Errors())->bookingValidation($vars["id"], $_POST["from"], $_POST["to"]);

        if (empty($_SESSION["Errors"])) {

            $apartmentPrice = (new ShowApartmentService())->execute(new ShowApartmentRequest($vars["id"]));
            $price = number_format(count(range(str_replace("-", "", $_POST["from"]), str_replace("-", "", $_POST["to"]))) * $apartmentPrice->getPrice(), 2);

            (new AddReservationService())->execute(new AddReservationRequest(
                $_SESSION["login"]["id"],
                $vars["id"],
                $_POST["from"],
                $_POST["to"],
                $price
            ));

        }
        return new Redirect("/show/" . $vars["id"]);

    }

    public function cancel($vars): Redirect
    {

        (new CancelReservationService())->execute(new CancelReservationRequest($vars["id"]));
        return new Redirect("/reservations");

    }
}