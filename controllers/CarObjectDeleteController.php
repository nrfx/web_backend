<?php

// в кой то веки наследуемся не от TwigBaseController а от BaseController
class CarObjectDeleteController extends BaseController
{
    public function post(array $context)
    {
        $id = $this->params['id'];

        $sql = <<<EOL
DELETE FROM car_objects WHERE id = :id
EOL; // сформировали запрос

        // выполнили
        $query = $this->pdo->prepare($sql);
        $query->bindValue(":id", $id);
        $query->execute();

        header("Location: /");
        exit;
    }
}