<?php

namespace App\Controllers;

use App\Database;
use App\Errors;
use App\Redirect;
use App\Services\UserProfile\NewUserProfileRequest;
use App\Services\UserProfile\NewUserProfileService;
use App\View;


class UserController
{

    public function register()
    {
        if (!empty($_SESSION["login"])) {
            return new Redirect("/login");
        } else {

            return new View("register.html", [
                "error" => $_SESSION["Errors"]
            ]);
        }
    }

    public function login()
    {
        if (!empty($_SESSION["login"])) {
            return new Redirect("/home");
        } else {
            return new View("login.html", [
                "error" => $_SESSION["Errors"]
            ]);
        }
    }

    public function logout(): Redirect
    {
        unset($_SESSION["login"]);
        return new Redirect("/login");
    }

    public function store(): Redirect
    {

        (new Errors())->registerValidation($_POST["name"], $_POST["surname"], $_POST["pwd"], $_POST["pwdRepeat"], $_POST["email"], $_POST["phoneNumber"]);

        if (empty($_SESSION["Errors"])) {

            (new NewUserProfileService())->execute(new NewUserProfileRequest(
                $_POST["name"],
                $_POST["surname"],
                $_POST["pwd"],
                $_POST["pwdRepeat"],
                $_POST["email"],
                $_POST["phoneNumber"]
            ));

            return new Redirect("/login");
        } else {
            return new Redirect("/register");
        }

    }

    public function session(): Redirect
    {
        $dataBase = Database::connection();
        $userData = $dataBase->fetchAssociative('SELECT * FROM users WHERE email = ?', [$_POST["emailLogin"]]);

        (new Errors())->loginValidation($_POST["emailLogin"], $_POST["pwdLogin"]);

        if (empty($_SESSION["Errors"])) {

            $userProfile = $dataBase->fetchAssociative('SELECT * FROM users_profile WHERE user_id = ?', [$userData["id"]]);

            $_SESSION["login"] = ["id" => $userProfile["user_id"], "name" => $userProfile["name"], "surname" => $userProfile["surname"]];

            return new Redirect("/home");
        } else {
            return new Redirect("/login");
        }
    }
}
