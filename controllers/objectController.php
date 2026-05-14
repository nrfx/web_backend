<?php
require_once __DIR__ . "/BaseCarTwigController.php";
class ObjectController extends BaseCarTwigController
{
    public $template = "__object.twig"; // шаблон по умолчанию

    public function getContext(): array
    {
        $context = parent::getContext();

        $id = $this->params['id'];
        $show = $_GET['show'] ?? null;

        // Определяем какие поля тянуть из БД в зависимости от show
        if ($show === 'image') {
            $query = $this->pdo->prepare("SELECT title, image FROM car_objects WHERE id = :my_id");
            $query->bindValue("my_id", $id);
            $query->execute();
            $data = $query->fetch();

            $context['title'] = $data['title'];
            $context['imagePath'] = $data['image'];
            $this->template = "image.twig";
        } elseif ($show === 'info') {
            $query = $this->pdo->prepare("SELECT title, info FROM car_objects WHERE id = :my_id");
            $query->bindValue("my_id", $id);
            $query->execute();
            $data = $query->fetch();

            $context['title'] = $data['title'];
            $context['info'] = $data['info'];
            $this->template = "object_info.twig";
        } else {
            // Общая информация (по умолчанию)
            $query = $this->pdo->prepare("SELECT title, description, id FROM car_objects WHERE id = :my_id");
            $query->bindValue("my_id", $id);
            $query->execute();
            $data = $query->fetch();

            $context['title'] = $data['title'];
            $context['description'] = $data['description'];
        }

        // Меню объекта — теперь с GET-параметрами
        $context['objectMenu'] = [
            ['title' => 'Картинка', 'url' => '/car-objects/' . $id . '?show=image', 'active' => ($show === 'image')],
            ['title' => 'Информация', 'url' => '/car-objects/' . $id . '?show=info', 'active' => ($show === 'info')]
        ];
        $context["my_session_message"] = $_SESSION['welcome_message'] ?? '';
        $context["messages"] = isset($_SESSION['messages']) ? $_SESSION['messages'] : "";


        return $context;
    }

    public function get(array $context)
    {
        $context = $this->getContext();
        echo $this->twig->render($this->template, $context);
    }
}