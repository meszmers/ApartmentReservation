<?php
namespace App\Controllers;
use App\Database;
use App\Errors;
use App\Redirect;
use App\View;


class ApartmentsController {

    public function create()
    {
        return new View("Apartments/create.html", ["error" => $_SESSION["Errors"]]);
    }
    public function list()
    {
      $dataBase =  Database::connection();

        (new Errors())->listApartmentValidation(
            $_POST["country"],
            $_POST["address"],
            $_POST["description"],
            $_POST["rooms"],
            $_POST["availableFrom"],
            $_POST["availableTo"]);

      if(empty($_SESSION["Errors"])) {
          $dataBase->insert('apartments',
              [
                  "created_user_id" => $_SESSION["login"]["id"],
                  "country" => $_POST["country"],
                  "address" => $_POST["address"],
                  "description" => $_POST["description"],
                  "rooms" => $_POST["rooms"],
                  "available_from" => $_POST["availableFrom"],
                  "available_to" => $_POST["availableTo"]
              ]);

          return new Redirect("/home");
      } else {
          return new Redirect("/create");
      }


    }
}