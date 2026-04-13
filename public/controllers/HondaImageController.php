<?php
require_once "HondaController.php";

class HondaImageController extends HondaController {
    public $template = "image.twig";

    public function getContext() : array
    {
        $context = parent::getContext();
        $context['imagePath'] = "/images/honda.jpg";
        $context['objectMenu'] = [
            ['title' => 'Картинка', 'url' => '/honda/image', 'active' => true],
            ['title' => 'Информация', 'url' => '/honda/info', 'active' => false]
        ];

        return $context;
    }
}