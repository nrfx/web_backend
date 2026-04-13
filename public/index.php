<?php

require_once '../vendor/autoload.php';
require_once "controllers/MainController.php";
require_once "controllers/ToyotaController.php";
require_once "controllers/ToyotaImageController.php";
require_once "controllers/ToyotaInfoController.php";
require_once "controllers/Controller404.php"; 
require_once "controllers/HondaController.php";
require_once "controllers/HondaImageController.php";
require_once "controllers/HondaInfoController.php";
require_once "controllers/Controller404.php";

$loader = new \Twig\Loader\FilesystemLoader('../views');

$twig = new \Twig\Environment($loader);

$url = $_SERVER["REQUEST_URI"];

$title = "";
$template = "";

$context = [];
$controller = null; 

$menu = [
        ['title' => 'Главная', 'url' => '/'],
        ['title' => 'Honda', 'url' => '/honda'],
        ['title' => 'Toyota', 'url' => '/toyota']
    ];

$objects = [
    [
        'name' => 'Honda',
        'items' => [
            ['title' => 'Honda', 'url' => '/honda/'],
            ['title' => 'Картинка', 'url' => '/honda/image'],
            ['title' => 'Информация', 'url' => '/honda/info']
        ]
    ],
    [
        'name' => 'Toyota',
        'items' => [
            ['title' => 'Toyota', 'url' => '/toyota/'],
            ['title' => 'Картинка', 'url' => '/toyota/image'],
            ['title' => 'Информация', 'url' => '/toyota/info']
        ]
    ]
];

if ($url == "/") {
    $title = "Главная";
    $template = "main.twig";
    $context['objects'] = $objects;
} elseif (preg_match("#^/toyota/image#", $url)) {
    $title = "Toyota";
    $template = "image.twig";
    $context['imagePath'] = "/images/car.jpg";
    $context['objectMenu'] = [
        ['title' => 'Картинка', 'url' => '/toyota/image', 'active' => true],
        ['title' => 'Информация', 'url' => '/toyota/info', 'active' => false]
    ];
} elseif (preg_match("#^/toyota/info#", $url)) {
    $title = "Toyota";
    $template = "toyota_info.twig";
    $context['objectMenu'] = [
        ['title' => 'Картинка', 'url' => '/toyota/image', 'active' => false],
        ['title' => 'Информация', 'url' => '/toyota/info', 'active' => true]
    ];
} elseif (preg_match("#^/toyota#", $url)) {
    $title = "Toyota";
    $template = "__object.twig";
    $context['objectMenu'] = [
        ['title' => 'Картинка', 'url' => '/toyota/image', 'active' => false],
        ['title' => 'Информация', 'url' => '/toyota/info', 'active' => false]
    ];
} elseif (preg_match("#^/honda/image#", $url)) {
    $title = "Honda";
    $template = "image.twig";
    $context['imagePath'] = "/images/honda.jpg";
    $context['objectMenu'] = [
        ['title' => 'Картинка', 'url' => '/honda/image', 'active' => true],
        ['title' => 'Информация', 'url' => '/honda/info', 'active' => false]
    ];
} elseif (preg_match("#^/honda/info#", $url)) {
    $title = "Honda";
    $template = "honda_info.twig";
    $context['objectMenu'] = [
        ['title' => 'Картинка', 'url' => '/honda/image', 'active' => false],
        ['title' => 'Информация', 'url' => '/honda/info', 'active' => true]
    ];
} elseif (preg_match("#^/honda#", $url)) {
    $title = "Honda";
    $template = "__object.twig";
    $context['objectMenu'] = [
        ['title' => 'Картинка', 'url' => '/honda/image', 'active' => false],
        ['title' => 'Информация', 'url' => '/honda/info', 'active' => false]
    ];
}

if ($url == "/") {
    $controller = new MainController($twig);
} elseif (preg_match("#^/toyota/image#", $url)) { 
    $controller = new ToyotaImageController($twig);
} elseif (preg_match("#^/toyota/info#", $url)) {
    $controller = new ToyotaInfoController($twig);
} elseif (preg_match("#^/toyota#", $url)) {
    $controller = new ToyotaController($twig);
} elseif (preg_match("#^/honda/image#", $url)) {
    $controller = new HondaImageController($twig);
} elseif (preg_match("#^/honda/info#", $url)) {
    $controller = new HondaInfoController($twig);
} elseif (preg_match("#^/honda#", $url)) {
    $controller = new HondaController($twig);
} 

$context['title'] = $title;
$context['menu'] = $menu;

if ($controller) {
    $controller_context = $controller->getContext();
    $context = array_merge($context, $controller_context);
    echo $twig->render($controller->template, $context);
} elseif ($template) {
    echo $twig->render($template, $context);
} else {
    $controller404 = new Controller404($twig);
    $context = array_merge($context, $controller404->getContext());
    http_response_code(404);
    echo $twig->render($controller404->template, $context);
}