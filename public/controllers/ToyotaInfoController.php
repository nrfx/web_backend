<?php
require_once "ToyotaController.php";

class ToyotaInfoController extends ToyotaController {
    public $template = "toyota_info.twig";

    public function getContext() : array
    {
        $context = parent::getContext();
        $context['objectMenu'] = [
            ['title' => 'Картинка', 'url' => '/toyota/image', 'active' => false],
            ['title' => 'Информация', 'url' => '/toyota/info', 'active' => true]
        ];

        return $context;
    }
}