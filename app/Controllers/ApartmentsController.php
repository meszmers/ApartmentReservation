<?php

namespace App\Controllers;


use App\Errors;
use App\Redirect;
use App\Services\Apartment\DeleteApartmentRequest;
use App\Services\Apartment\DeleteApartmentService;
use App\Services\Apartment\GetAllApartmentRequest;
use App\Services\Apartment\GetAllApartmentService;
use App\Services\Apartment\ShowApartmentRequest;
use App\Services\Apartment\ShowApartmentService;
use App\Services\Apartment\StoreApartmentRequest;
use App\Services\Apartment\StoreApartmentService;
use App\Services\Apartment\UpdateApartmentRequest;
use App\Services\Apartment\UpdateApartmentService;
use App\Services\Reservation\GetAllByApartmentReservationRequest;
use App\Services\Reservation\GetAllByApartmentReservationService;
use App\Services\Review\GetAllReviewRequest;
use App\Services\Review\GetAllReviewService;
use App\Services\UserProfile\ShowUserProfileRequest;
use App\Services\UserProfile\ShowUserProfileService;
use App\View;
use Carbon\CarbonPeriod;


class ApartmentsController
{

    public function create()
    {
        if (!empty($_SESSION["login"])) {
            return new View("Apartments/create.html", ["error" => $_SESSION["Errors"]]);
        } else {
            return new Redirect("/login");
        }
    }


    public function store(): Redirect
    {

        (new Errors())->listApartmentValidation(
            $_POST["country"],
            $_POST["address"],
            $_POST["description"],
            $_POST["rooms"],
            $_POST["availableFrom"],
            $_POST["availableTo"],
            $_POST["price"]);

        if (empty($_SESSION["Errors"])) {

            $fileName = uniqid("", true) . "." . explode(".", $_FILES["picture"]["name"])[1];
            move_uploaded_file($_FILES["picture"]["tmp_name"], "Uploads/Apartments/" . $fileName);

            $apartmentObj = new StoreApartmentRequest(
                $_SESSION["login"]["id"],
                $_POST["country"],
                $_POST["address"],
                $_POST["description"],
                $_POST["rooms"],
                $_POST["availableFrom"],
                $_POST["availableTo"],
                $_POST["price"],
                $fileName);

            (new StoreApartmentService())->execute($apartmentObj);

            return new Redirect("/home");
        } else {
            return new Redirect("/create");
        }
    }


    public function show($vars)
    {

        if (!empty($_SESSION["login"])) {

            $apartment = (new ShowApartmentService)->execute(new ShowApartmentRequest($vars["id"]));
            $userProfile = (new ShowUserProfileService())->execute(new ShowUserProfileRequest($apartment->getCreatedUserId()));
            $reservations = (new GetAllByApartmentReservationService())->execute(new GetAllByApartmentReservationRequest($apartment->getId()));



            $bookedDays = [];
            foreach ($reservations as $reservation) {

                $range = CarbonPeriod::create($reservation->getDayFrom(), $reservation->getDayTo());

                foreach ($range as $add) {
                    $bookedDays[] = $add->format('Y-m-d');
                }
            }


            $reviews = (new GetAllReviewService())->execute(new GetAllReviewRequest($apartment->getId()));

            $allReviews = [];
            $apartmentRatingList = [];

            foreach ($reviews as $review) {
                $user = (new ShowUserProfileService())->execute(new ShowUserProfileRequest($review->getUserId()));
                $allReviews[] = ["reviewInfo" => $review, "userInfo" => $user];
                $apartmentRatingList[] = $review->getRating();
            }


            if (!empty($apartmentRatingList)) {
                $apartmentRating = floor(array_sum($apartmentRatingList) / count($apartmentRatingList));
            } else {
                $apartmentRating = 0;
            }


            return new View("Apartments/show.html", [
                "apartmentInfo" => ["apartment" => $apartment, "userProfile" => $userProfile],
                "reservations" => $reservations,
                "bookedDays" => $bookedDays,
                "reviews" => $allReviews,
                "stars" => ["g" => $apartmentRating, "b" => 5 - $apartmentRating],
                "error" => $_SESSION["Errors"]]);
        } else {
            return new Redirect("/login");
        }
    }


    public function userAdvertisements()
    {
        if (!empty($_SESSION["login"])) {

            $list = (new GetAllApartmentService())->execute(new GetAllApartmentRequest($_SESSION["login"]["id"]));
            return new View("Apartments/adverts.html", ["apartments" => $list]);
        } else {
            return new Redirect("/login");
        }
    }


    public function remove($vars): Redirect
    {
        (new DeleteApartmentService())->execute(new DeleteApartmentRequest($vars["id"]));

        return new Redirect("/advertisements");
    }


    public function edit($vars)
    {
        if (!empty($_SESSION["login"])) {

            $apartment = (new ShowApartmentService())->execute(new ShowApartmentRequest($vars["id"]));
            return new View("Apartments/edit.html", ["apartment" => $apartment, "error" => $_SESSION["Errors"]]);
        } else {
            return new Redirect("/login");
        }
    }


    public function update($vars): Redirect
    {
        (new UpdateApartmentService())->execute(new UpdateApartmentRequest(
            $_POST["country"],
            $_POST["address"],
            $_POST["description"],
            $_POST["rooms"],
            $_POST["price"],
            $vars["id"]
        ));

        return new Redirect("/advertisements");

    }
}