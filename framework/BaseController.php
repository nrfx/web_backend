<?php

abstract class BaseController
{
    public PDO $pdo; // добавил поле
    public array $params;

    public function setPDO(PDO $pdo)
    { // и сеттер для него
        $this->pdo = $pdo;
    }

    public function setParams(array $params)
    {
        $this->params = $params;
    }
    // остальное не трогаем
    public function getContext(): array
    {
        return [
            'visited_pages' => $_SESSION['visited_pages'] ?? []
        ];
    }

    public function process_response()
    {
        // записываем текущую страницу в историю посещений
        $currentUrl = urldecode($_SERVER['REQUEST_URI']);
        if (!isset($_SESSION['visited_pages'])) {
            $_SESSION['visited_pages'] = [];
        }
        array_push($_SESSION['visited_pages'], $currentUrl);
        // оставляем только последние 10
        $_SESSION['visited_pages'] = array_slice($_SESSION['visited_pages'], -10);

        $method = $_SERVER['REQUEST_METHOD']; // вытаскиваем метод
        $context = $this->getContext();
        if ($method == 'GET') { // если GET запрос то вызываем get
            $this->get($context);
        } else if ($method == 'POST') { // если POST запрос то вызываем get
            $this->post($context);
        }
    }

    public function get(array $context)
    {
    }
    public function post(array $context)
    {
    }
}