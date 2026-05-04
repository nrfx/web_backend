<?php

class ObjectImageController extends TwigBaseController
{
    public $template = "image.twig";

    public function getContext(): array
    {
        $context = parent::getContext();

        $query = $this->pdo->prepare("SELECT title, image FROM car_objects WHERE id = :my_id");
        $query->bindValue("my_id", $this->params['id']);
        $query->execute();

        $data = $query->fetch();

        $context['title'] = $data['title'];
        $context['objectMenu'] = [
            ['title' => 'Картинка', 'url' => '/car-objects/' . $this->params['id'] . '/image', 'active' => false],
            ['title' => 'Информация', 'url' => '/car-objects/' . $this->params['id'] . '/info', 'active' => false]
        ];
        $context['imagePath'] = $data['image'];

        return $context;
    }
}
