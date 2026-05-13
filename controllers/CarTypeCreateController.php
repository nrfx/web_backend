<?php

class CarTypeCreateController extends BaseCarTwigController
{
    public $template = "car_type_create.twig";

    public function get(array $context)
    {
        parent::get($context);
    }

    public function post(array $context)
    {
        $title = $_POST['title'];

        // проверяем, загружен ли файл изображения
        if (!empty($_FILES['image']['tmp_name'])) {
            $tmp_name = $_FILES['image']['tmp_name'];
            $name = $_FILES['image']['name'];
            move_uploaded_file($tmp_name, "../public/media/$name");
            $image_url = "/media/$name";

            $sql = <<<EOL
INSERT INTO car_types(title, image) VALUES(:title, :image)
EOL;

            $query = $this->pdo->prepare($sql);
            $query->bindValue("title", $title);
            $query->bindValue("image", $image_url);
        } else {
            $sql = <<<EOL
INSERT INTO car_types(title) VALUES(:title)
EOL;

            $query = $this->pdo->prepare($sql);
            $query->bindValue("title", $title);
        }

        $query->execute();

        // перезагружаем контекст, чтобы список типов содержал новый тип
        $context = $this->getContext();
        $context['message'] = 'Тип успешно добавлен';

        $this->get($context);
    }
}
