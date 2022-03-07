<?php
namespace App\Controllers;

use App\Redirect;
use App\View;

class WebsiteController {

    public function index()
    {
        $apartments = (new ModelArrayController)->ApartmentInfoArray();

        return new View("Apartments/home.html", ["apartments"=> $apartments]);
    }

    public function send() {
        return new Redirect("/login");
    }
}
