<?php
require_once __DIR__ . "/BaseCarTwigController.php";

class SearchController extends BaseCarTwigController
{
    public $template = "search.twig";

    public function getContext(): array
    {
        $context = parent::getContext();

        $type = isset($_GET['type']) ? $_GET['type'] : '';
        $title = isset($_GET['title']) ? $_GET['title'] : '';
        $info = isset($_GET['info']) ? $_GET['info'] : '';

        $sql = <<<EOL
SELECT id, title, image
FROM car_objects
WHERE (:title = '' OR title like CONCAT('%', :title, '%')) 
    AND (:info = '' OR info like CONCAT('%', :info, '%'))
    AND (:type = '' OR type = :type)
EOL;
        $query = $this->pdo->prepare($sql);

        $query->bindValue(':title', $title);
        $query->bindValue("type", $type);
        $query->bindValue("info", $info);
        $query->execute();

        $context['objects'] = $query->fetchAll();

        // передаём текущие значения фильтров обратно в шаблон
        $context['search_type'] = $type;
        $context['search_title'] = $title;
        $context['search_info'] = $info;

        return $context;
    }
}