<?php
require_once "HondaController.php";

class HondaInfoController extends HondaController {
    public $template = "honda_info.twig";

    public function getContext() : array
    {
        $context = parent::getContext();
        $context['objectMenu'] = [
            ['title' => 'Картинка', 'url' => '/honda/image', 'active' => false],
            ['title' => 'Информация', 'url' => '/honda/info', 'active' => true]
        ];

        return $context;
    }
}