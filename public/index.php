<?php

require_once '../vendor/autoload.php';
require_once "framework/autoload.php";
require_once "controllers/MainController.php";
require_once "controllers/ToyotaController.php";
require_once "controllers/ToyotaImageController.php";
require_once "controllers/ToyotaInfoController.php";
require_once "controllers/Controller404.php";
require_once "controllers/HondaController.php";
require_once "controllers/HondaImageController.php";
require_once "controllers/HondaInfoController.php";
require_once "controllers/ObjectController.php";


$loader = new \Twig\Loader\FilesystemLoader('../views');

$twig = new \Twig\Environment($loader, [
    "debug" => true
]);
$twig->addExtension(new \Twig\Extension\DebugExtension());

$pdo = new PDO("mysql:host=localhost;dbname=my_db;charset=utf8", "root", "");

$router = new Router($twig, $pdo);
$router->add("/", MainController::class);
$router->add("/toyota/image", ToyotaImageController::class);
$router->add("/toyota/info", ToyotaInfoController::class);
$router->add("/toyota", ToyotaController::class);
$router->add("/honda/image", HondaImageController::class);
$router->add("/honda/info", HondaInfoController::class);
$router->add("/honda", HondaController::class);

$router->add("/car-objects/(?P<id>\d+)", ObjectController::class);
$router->get_or_default(Controller404::class);
