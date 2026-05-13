<?php

require_once '../vendor/autoload.php';
require_once "../framework/autoload.php";
require_once "../controllers/MainController.php";
require_once "../controllers/Controller404.php";
require_once "../controllers/ObjectController.php";
require_once "../controllers/SearchController.php";
require_once "../controllers/CarObjectCreateController.php";
require_once "../controllers/CarObjectDeleteController.php";
require_once "../controllers/CarObjectUpdateController.php";
require_once "../controllers/CarTypeCreateController.php";
require_once "../middlewares/LoginRequiredMiddleware.php";

$loader = new \Twig\Loader\FilesystemLoader('../views');

$twig = new \Twig\Environment($loader, [
    "debug" => true
]);
$twig->addExtension(new \Twig\Extension\DebugExtension());

$pdo = new PDO("mysql:host=localhost;dbname=my_db;charset=utf8", "root", "");

$router = new Router($twig, $pdo);
$router->add("/", MainController::class)->middleware(new LoginRequiredMiddleware());
$router->add("/search", SearchController::class)->middleware(new LoginRequiredMiddleware());
$router->add("/car-objects/create", CarObjectCreateController::class)->middleware(new LoginRequiredMiddleware());
$router->add("/car-types/create", CarTypeCreateController::class)->middleware(new LoginRequiredMiddleware());
$router->add("/car-objects/(?P<id>\d+)/delete", CarObjectDeleteController::class)->middleware(new LoginRequiredMiddleware());
$router->add("/car-objects/(?P<id>\d+)/update", CarObjectUpdateController::class)->middleware(new LoginRequiredMiddleware());
$router->add("/car-objects/(?P<id>\d+)", ObjectController::class)->middleware(new LoginRequiredMiddleware());
$router->get_or_default(Controller404::class);
