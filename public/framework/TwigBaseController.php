<?php
require_once "BaseController.php";

class TwigBaseController extends BaseController
{
    public $title = "";
    public $template = "";
    protected \Twig\Environment $twig;


    public function setTwig($twig)
    {
        $this->twig = $twig;
    }

    // переопределяем функцию контекста
    public function getContext(): array
    {
        $context = parent::getContext();
        $context['title'] = $this->title;
        $context['menu'] = [
            ['title' => 'Главная', 'url' => '/']
        ];

        return $context;
    }


    public function get()
    {
        echo $this->twig->render($this->template, $this->getContext());
    }
}
