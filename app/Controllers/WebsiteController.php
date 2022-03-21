<?php

namespace App\Controllers;

use App\Redirect;
use App\View;

class WebsiteController
{

    public function index()
    {
        if (!empty($_SESSION["login"])) {
            $apartments = (new ModelArrayController)->ApartmentInfoArray();

            return new View("Apartments/home.html", ["apartments" => $apartments]);
        } else {
            return new Redirect("/login");
        }
    }

    public function send()
    {
        return new Redirect("/login");
    }

    public function error()
    {
        return new View("error.html");
    }
}
