<?php

class CarObjectUpdateController extends BaseCarTwigController
{
    public $template = "car_object_create.twig";

    public function get(array $context)
    {
        $id = $this->params['id'];

        $sql = <<<EOL
SELECT * FROM car_objects WHERE id = :id
EOL;

        $query = $this->pdo->prepare($sql);
        $query->bindValue("id", $id);
        $query->execute();

        $data = $query->fetch();

        $context['object'] = $data;

        parent::get($context);
    }

    public function post(array $context)
    {
        $id = $this->params['id'];

        // получаем значения полей с формы
        $title = $_POST['title'];
        $description = $_POST['description'];
        $type = $_POST['type'];
        $info = $_POST['info'];

        // проверяем, загружен ли новый файл
        if (!empty($_FILES['image']['tmp_name'])) {
            $tmp_name = $_FILES['image']['tmp_name'];
            $name = $_FILES['image']['name'];
            move_uploaded_file($tmp_name, "../public/media/$name");
            $image_url = "/media/$name";

            $sql = <<<EOL
UPDATE car_objects SET title = :title, description = :description, type = :type, info = :info, image = :image_url WHERE id = :id
EOL;

            $query = $this->pdo->prepare($sql);
            $query->bindValue("image_url", $image_url);
        } else {
            $sql = <<<EOL
UPDATE car_objects SET title = :title, description = :description, type = :type, info = :info WHERE id = :id
EOL;

            $query = $this->pdo->prepare($sql);
        }

        $query->bindValue("title", $title);
        $query->bindValue("description", $description);
        $query->bindValue("type", $type);
        $query->bindValue("info", $info);
        $query->bindValue("id", $id);

        $query->execute();

        $context['message'] = 'Объект успешно обновлён';
        $context['id'] = $id;

        $this->get($context);
    }
}