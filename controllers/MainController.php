<?php
require_once __DIR__ . "/BaseCarTwigController.php";

class MainController extends BaseCarTwigController
{
    public $template = "main.twig";
    public $title = "Главная";
    public function getContext(): array
    {
        $context = parent::getContext();

        if (isset($_GET['type'])) {
            $query = $this->pdo->prepare("SELECT * FROM car_objects WHERE type = :type");
            $query->bindValue("type", $_GET['type']);
            $query->execute();
        } else {
            $query = $this->pdo->query("SELECT * FROM car_objects");
        }

        $context['car_objects'] = $query->fetchAll();

        return $context;
    }
}