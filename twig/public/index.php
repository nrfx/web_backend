<?php

require_once '../vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader('../views');

$twig = new \Twig\Environment($loader);

$url = $_SERVER["REQUEST_URI"];

$title = "";
$template = "";

$context = [];
$menu = [
    [
        "title" => "Главная",
        "url" => "/",
    ],
    [
        "title" => "Toyota",
        "url" => "/toyota",
    ],
    [
        "title" => "Honda",
        "url" => "/honda",
    ]
];

if ($url == "/") {
    $title = "Главная";
    $template = "main.twig";
} elseif (preg_match("#/toyota#", $url)) {
    $title = "Toyota";
    $template = "base_image.twig";

    $context['image'] = "/images/toyota.jpg";
} elseif (preg_match("#/honda#", $url)) {
    $title = "Honda";
    $template = "base_image.twig";

    $context['image'] = "/images/honda.jpg";
}

$context['title'] = $title;
$context['menu'] = $menu;


echo $twig->render($template, $context);