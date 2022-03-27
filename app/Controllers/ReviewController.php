<?php

namespace App\Controllers;


use App\Errors;
use App\Redirect;
use App\Services\Review\AddReviewRequest;
use App\Services\Review\AddReviewService;

class ReviewController
{

    public function review($vars): Redirect
    {

        (new Errors())->reviewErrors($vars["id"], $_POST["review"], $_POST["rating"]);

        if (empty($_SESSION["Errors"])) {
            (new AddReviewService())->execute(new AddReviewRequest(
                $_SESSION["login"]["id"],
                $vars["id"],
                $_POST["rating"],
                $_POST["review"]
            ));
        }

        return new Redirect("/show/" . $vars["id"]);

    }
}