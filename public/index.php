<?php

require_once '../vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader('../views');

$twig = new \Twig\Environment($loader);

$url = $_SERVER["REQUEST_URI"];

$title = "";
$template = "";

$context = [];

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

$context['title'] = $title;
$context['menu'] = $menu;


echo $twig->render($template, $context);