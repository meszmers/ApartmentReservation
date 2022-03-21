<?php

require_once 'vendor/autoload.php';

use App\Redirect;
use App\View;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

session_start();

$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
    //UsersController Routes

    $r->addRoute('GET', '/login', [App\Controllers\UsersController::class, "login"]);
    $r->addRoute('GET', '/register', [App\Controllers\UsersController::class, "register"]);
    $r->addRoute('GET', '/logout', [App\Controllers\UsersController::class, "logout"]);

    $r->addRoute('POST', '/login', [App\Controllers\UsersController::class, "session"]);
    $r->addRoute('POST', '/register', [App\Controllers\UsersController::class, "store"]);

    //Website Routes
    $r->addRoute('GET', '/', [App\Controllers\WebsiteController::class, "send"]);
    $r->addRoute('GET', '/home', [App\Controllers\WebsiteController::class, "index"]);

    //ApartmentEdit Routes
    $r->addRoute('GET', '/create', [App\Controllers\ApartmentsController::class, "create"]);
    $r->addRoute('POST', '/create', [App\Controllers\ApartmentsController::class, "list"]);
    $r->addRoute('GET', '/show/{id:\d+}', [App\Controllers\ApartmentsController::class, "show"]);
    $r->addRoute('POST', '/show/{id:\d+}/remove', [App\Controllers\ApartmentsController::class, "remove"]);

    //Reservation Routes
    $r->addRoute('POST', '/show/{id:\d+}/reserve', [App\Controllers\ReservationController::class, "reserve"]);
    $r->addRoute('GET', '/reservations', [App\Controllers\ReservationController::class, "userReservations"]);
    $r->addRoute('GET', '/advertisements', [App\Controllers\ApartmentsController::class, "userAdvertisements"]);
    $r->addRoute('POST', '/show/{id:\d+}/cancel', [App\Controllers\ReservationController::class, "cancel"]);
    $r->addRoute('GET', '/show/{id:\d+}/edit', [App\Controllers\ApartmentsController::class, "edit"]);
    $r->addRoute('POST', '/show/{id:\d+}/update', [App\Controllers\ApartmentsController::class, "update"]);

    //Review Routes
    $r->addRoute('POST', '/show/{id:\d+}/review', [App\Controllers\ReviewController::class, "review"]);


});

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        echo "404 Not Found";
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        // ... 405 Method Not Allowed
        break;
    case FastRoute\Dispatcher::FOUND:

        $controller = $routeInfo[1][0];
        $method = $routeInfo[1][1];

        $vars = $routeInfo[2];


        $response = (new $controller)->$method($vars);

        $twig = new Environment(new FilesystemLoader('app/Views'));


        if($response instanceof View) {
            echo $twig->render($response->getPath(), $response->getVars());
        }

        if($response instanceof Redirect) {
            header('Location: ' . $response->getLocation());
        }

        break;
}


if (isset($_SESSION['Errors']) && $httpMethod == "GET"){
    unset($_SESSION['Errors']);
}
