<?php 

class BaseCarTwigController extends TwigBaseController {
    public function getContext(): array
    {
        $context = parent::getContext();
        $query = $this->pdo->query("SELECT * FROM car_types ORDER BY title");
        $types = $query->fetchAll();
        
        $context['types'] = $types;

        return $context;
    }
}