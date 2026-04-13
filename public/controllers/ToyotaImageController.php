<?php
require_once "ToyotaController.php";

class ToyotaImageController extends ToyotaController {
    public $template = "image.twig";

    public function getContext() : array
    {
        $context = parent::getContext();
        $context['imagePath'] = "/images/car.jpg";
        $context['objectMenu'] = [
            ['title' => 'Картинка', 'url' => '/toyota/image', 'active' => true],
            ['title' => 'Информация', 'url' => '/toyota/info', 'active' => false]
        ];

        return $context;
    }
}