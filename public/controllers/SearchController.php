<?php
require_once "BaseCarTwigController.php";

class SearchController extends BaseCarTwigController
{
    public $template = "search.twig";

    public function getContext(): array
    {
        $context = parent::getContext();

        $type = isset($_GET['type']) ? $_GET['type'] : '';
        $title = isset($_GET['title']) ? $_GET['title'] : '';

        $sql = <<<EOL
SELECT id, title
FROM car_objects
WHERE (:title = '' OR title like CONCAT('%', :title, '%'))
    AND (type = :type)
EOL;
        $query = $this->pdo->prepare($sql);

        $query->bindValue(':title', $title);
        $query->bindValue("type", $type);
        $query->execute();

        $context['objects'] = $query->fetchAll();

        return $context;
    }
}