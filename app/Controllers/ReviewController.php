<?php
namespace App\Controllers;

use App\Database;
use App\Errors;
use App\Redirect;
use App\View;

class ReviewController {

    public function review($vars) {

        (new Errors())->reviewErrors($vars["id"], $_POST["review"], $_POST["rating"]);

        if(empty($_SESSION["Errors"])) {

            $dataBase = Database::connection();
            $dataBase->insert('reviews',
                [
                    "user_id" => $_SESSION["login"]["id"],
                    "apartment_id" => $vars["id"],
                    "rating" => $_POST["rating"],
                    "review" => $_POST["review"]
                ]);
        }

        return new Redirect("/show/". $vars["id"]);

    }
}