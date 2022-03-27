<?php

namespace App\Controllers;

use App\Redirect;
use App\Services\Apartment\GetAllApartmentRequest;
use App\Services\Apartment\GetAllApartmentService;
use App\View;

class WebsiteController
{

    public function index()
    {
        if (!empty($_SESSION["login"])) {

            $apartments = (new GetAllApartmentService())->execute(new GetAllApartmentRequest());

            return new View("Apartments/home.html", ["apartments" => $apartments]);
        } else {
            return new Redirect("/login");
        }
    }


    public function send(): Redirect
    {
        return new Redirect("/login");
    }

}
