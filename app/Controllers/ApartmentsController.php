<?php

namespace App\Controllers;

use App\Database;
use App\Errors;
use App\Models\ApartmentEdit;
use App\Models\ApartmentInfo;
use App\Models\DetailedApartmentInfo;
use App\Models\Reservation;
use App\Models\ReviewInfo;
use App\Redirect;
use App\View;
use Carbon\Carbon;
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

    public function show($vars)
    {
        if (!empty($_SESSION["login"])) {

            $dataBase = Database::connection();
            $apartment = $dataBase->fetchAssociative('SELECT * FROM apartments WHERE id = ?', [$vars["id"]]);

            $user = $dataBase->fetchAssociative(
                'SELECT name, surname, phone_number, email FROM users_profile WHERE user_id = ?', [$apartment["created_user_id"]]);
            $apartmentObject = new DetailedApartmentInfo(
                $apartment["id"],
                $user["name"],
                $user["surname"],
                $user["phone_number"],
                $user["email"],
                $apartment["country"],
                $apartment["address"],
                $apartment["description"],
                $apartment["rooms"],
                $apartment["available_from"],
                $apartment["available_to"],
                $apartment["created_at"],
                number_format($apartment["price"], 2),
                $apartment["picture"]);

            $reservations = $dataBase->fetchAllAssociative(
                'SELECT day_from, day_to FROM reservations WHERE apartment_id = ?', [$vars["id"]]);

            $bookedDays = [];

            foreach ($reservations as $getRange) {
                $range = CarbonPeriod::create($getRange["day_from"], $getRange["day_to"]);
                foreach ($range as $add) {
                    $bookedDays[] = $add->format('Y-m-d');
                }
            }

            $reviews = $dataBase->fetchALLAssociative('SELECT * FROM reviews WHERE apartment_id = ?', [$vars["id"]]);
            $allReviews = [];
            $apartmentRatingList = [];
            foreach ($reviews as $review) {
                $user = $dataBase->fetchAssociative('SELECT name, surname FROM users_profile WHERE user_id = ?', [$review["user_id"]]);
                $apartmentRatingList[] = $review["rating"];
                $allReviews[] = new ReviewInfo(
                    $review["id"],
                    $review["user_id"],
                    $review["apartment_id"],
                    $review["rating"],
                    $review["review"],
                    $user["name"],
                    $user["surname"],
                    $review["created_at"]
                );
            }
            if(!empty($apartmentRatingList)) {
                $apartmentRating = floor(array_sum($apartmentRatingList) / count($apartmentRatingList));
            } else {
                $apartmentRating = 0;
            }





            return new View("Apartments/show.html", [
                "apartment" => $apartmentObject,
                "error" => $_SESSION["Errors"],
                "reservations" => $reservations,
                "bookedDays" => $bookedDays,
                "reviews" => $allReviews,
                "stars" => ["g" => $apartmentRating, "b" => 5 - $apartmentRating]]);
        } else {
            return new Redirect("/login");
        }

    }

    public function list()
    {
        $dataBase = Database::connection();

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

            $dataBase->insert('apartments',
                [
                    "created_user_id" => $_SESSION["login"]["id"],
                    "country" => $_POST["country"],
                    "address" => $_POST["address"],
                    "description" => $_POST["description"],
                    "rooms" => $_POST["rooms"],
                    "available_from" => $_POST["availableFrom"],
                    "available_to" => $_POST["availableTo"],
                    "price" => $_POST["price"],
                    "picture" => $fileName
                ]);

            return new Redirect("/home");
        } else {
            return new Redirect("/create");
        }
    }


    public function userAdvertisements()
    {

        if (!empty($_SESSION["login"])) {

            $dataBase = Database::connection();
            $data = $dataBase->fetchAllAssociative(
                'SELECT * FROM apartments WHERE created_user_id = ?', [$_SESSION["login"]["id"]]);

            $list = [];
            foreach ($data as $construct) {
                $list[] = new ApartmentInfo(
                    $construct["id"],
                    $construct["created_user_id"],
                    $construct["country"],
                    $construct["address"],
                    $construct["description"],
                    $construct["rooms"],
                    $construct["available_from"],
                    $construct["available_to"],
                    $construct["created_at"],
                    $construct["price"],
                    $construct["picture"]);

            }

            return new View("Apartments/adverts.html", ["apartments" => $list]);

        } else {
            return new Redirect("/login");
        }
    }

    public function remove($vars)
    {
        $database = Database::connection();
        $database->delete('apartments', ['id' => $vars["id"]]);
        $database->delete('reviews', ['apartment_id' => $vars["id"]]);
        $database->delete('reservations', ['apartment_id' => $vars["id"]]);

        // unlink() need to check how to get to real folder and remove picture

        return new Redirect("/advertisements");
    }
    public function edit($vars) {
        if (!empty($_SESSION["login"])) {
            $dataBase = Database::connection();
            $apartment = $dataBase->fetchAssociative('SELECT * FROM apartments WHERE id = ?', [$vars["id"]]);

            $data = new ApartmentEdit(
                $apartment["id"],
                $apartment["created_user_id"],
                $apartment["country"],
                $apartment["address"],
                $apartment["description"],
                $apartment["rooms"],
                $apartment["price"]
            );

            return new View("Apartments/edit.html", ["apartment" => $data, "error" => $_SESSION["Errors"]]);
        } else return new Redirect("/login");
    }

    public function update($vars) {

        $dataBase = Database::connection();

        $dataBase->update('apartments',
            [
                "country" => $_POST["country"],
                "address" => $_POST["address"],
                "description" => $_POST["description"],
                "rooms" => $_POST["rooms"],
                "price" => $_POST["price"]
            ],
            ['id' => $vars["id"]]);



        return new Redirect("/advertisements");

    }
}