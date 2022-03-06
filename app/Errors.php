<?php
namespace App;

class Errors {
    public function registerValidation($name, $surname, $password, $passwordRepeat, $email, $phoneNumber)
    {
        $dataBase = Database::connection();
        $emailExists = $dataBase->fetchAssociative('SELECT * FROM users WHERE email = ?', [$email]);


        if (empty($name) || empty($surname) || empty($password) || empty($passwordRepeat) || empty($email) || empty($phoneNumber))
        {
            $_SESSION["Errors"] = "* Form was not filled.";
        }
        else if($emailExists !== false)
        {
            $_SESSION["Errors"] = "* E-mail already exists.";
        }
        else if ($password !== $passwordRepeat)
        {
            $_SESSION["Errors"] = "* Passwords do not match.";
        }
    }

    public function loginValidation($email, $password)
    {
        $dataBase = Database::connection();
        $userData = $dataBase->fetchAssociative('SELECT * FROM users WHERE email = ?', [$email]);
        if(empty($userData))
        {
            $_SESSION["Errors"] = "* Invalid E-mail address.";
        }
        else if(password_verify($password, $userData["password"]) == false)
        {
           $_SESSION["Errors"] = "* Invalid password.";
       }
    }

    public function listApartmentValidation($country, $address, $description, $rooms, $availableFrom, $availableTo) {
        if(empty($country) || empty($address) || empty($description) || empty($rooms) || empty($availableFrom) || empty($availableTo)) {
            $_SESSION["Errors"] = "* Form was not filled.";
        }
    }
}
