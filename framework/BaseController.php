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
        return [];
    }

    public function process_response()
    {
        session_set_cookie_params(60 * 60 * 10);
        session_start();
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