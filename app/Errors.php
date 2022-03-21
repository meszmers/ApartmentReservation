<?php

namespace App;

class Errors
{
    public function registerValidation($name, $surname, $password, $passwordRepeat, $email, $phoneNumber)
    {
        $dataBase = Database::connection();
        $emailExists = $dataBase->fetchAssociative('SELECT * FROM users WHERE email = ?', [$email]);


        if (empty($name) || empty($surname) || empty($password) || empty($passwordRepeat) || empty($email) || empty($phoneNumber)) {
            $_SESSION["Errors"] = "* Form was not filled.";
        } else if ($emailExists !== false) {
            $_SESSION["Errors"] = "* E-mail already exists.";
        } else if ($password !== $passwordRepeat) {
            $_SESSION["Errors"] = "* Passwords do not match.";
        }
    }

    public function loginValidation($email, $password)
    {
        $dataBase = Database::connection();
        $userData = $dataBase->fetchAssociative('SELECT * FROM users WHERE email = ?', [$email]);
        if (empty($userData)) {
            $_SESSION["Errors"] = "* Invalid E-mail address.";
        } else if (password_verify($password, $userData["password"]) == false) {
            $_SESSION["Errors"] = "* Invalid password.";
        }
    }

    public function listApartmentValidation($country, $address, $description, $rooms, $availableFrom, $availableTo, $price)
    {
        $fileFormat = explode(".", $_FILES["picture"]["name"])[1];
        $validFiles = ["jpg", "png"];
        if (empty($country) || empty($address) || empty($description) || empty($rooms) || empty($availableFrom) || empty($availableTo) || empty($price) || empty($_FILES["picture"])) {
            $_SESSION["Errors"] = "* Form was not filled.";
        } elseif (!in_array($fileFormat, $validFiles)) {
            $_SESSION["Errors"] = "* Available image formats are .jpg or .png.";
        } elseif (str_replace("-", "", $availableFrom) > str_replace("-", "", $availableTo)) {
            $_SESSION["Errors"] = "* Invalid date range.";
        }
    }

    public function bookingValidation($apartmentId, $bFrom, $bTo)
    {

        if (empty($bFrom) || empty($bFrom)) {

        }

        $dataBase = Database::connection();
        $userData = $dataBase->fetchAllAssociative('SELECT day_from, day_to FROM reservations WHERE apartment_id = ?', [$apartmentId]);

        $datesBooked = [];
        foreach ($userData as $getRange) {
            $range = range(str_replace("-", "", $getRange["day_from"]), str_replace("-", "", $getRange["day_to"]));
            foreach ($range as $add) {
                $datesBooked[] = $add;
            }
        }

        $pickedRange = range(str_replace("-", "", $bFrom), str_replace("-", "", $bTo));
        $bookingCheck = true;
        foreach ($pickedRange as $check) {
            if (in_array($check, $datesBooked)) {
                $bookingCheck = false;
                break;
            }
        }

        if ($bookingCheck == false) {
            $_SESSION["Errors"] = "* Some of the days are booked already";
        } elseif ($bFrom > $bTo) {
            $_SESSION["Errors"] = "* Wrong date order.";
        }
    }

    public function reviewErrors($apartmentId, $review, $rating)
    {

        $dataBase = Database::connection();
        $userData = $dataBase->fetchAssociative('SELECT * FROM reviews WHERE apartment_id = ? AND user_id = ?', [$apartmentId, $_SESSION["login"]["id"]]);


       if($userData == true) {
           $_SESSION["Errors"] = "* You can't post more than one Review.";
       } elseif (empty($review) || empty($rating)) {
           $_SESSION["Errors"] = "* You need to fill all fields.";
       }

    }
}
