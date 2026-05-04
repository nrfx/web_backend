<?php
//require_once "TwigBaseController.php";

class HondaController extends TwigBaseController
{
    public $template = "__object.twig";
    public $title = "Honda";

    public function getContext(): array
    {
        $context = parent::getContext();
        $context['objectMenu'] = [
            ['title' => 'Картинка', 'url' => '/honda/image', 'active' => false],
            ['title' => 'Информация', 'url' => '/honda/info', 'active' => false]
        ];

        return $context;
    }
}