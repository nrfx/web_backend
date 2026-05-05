<?php
require_once __DIR__ . "/BaseCarTwigController.php";

class Controller404 extends BaseCarTwigController
{
    public $template = "404.twig";
    public $title = "Страница не найдена";

    public function get(array $context)
    {
        http_response_code(404);
        parent::get($context);
    }
}