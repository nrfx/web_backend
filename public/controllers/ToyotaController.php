<?php
//require_once "TwigBaseController.php";

class ToyotaController extends TwigBaseController
{
    public $template = "__object.twig";
    public $title = "Toyota";

    public function getContext(): array
    {
        $context = parent::getContext();
        $context['objectMenu'] = [
            ['title' => 'Картинка', 'url' => '/toyota/image', 'active' => false],
            ['title' => 'Информация', 'url' => '/toyota/info', 'active' => false]
        ];

        return $context;
    }
}