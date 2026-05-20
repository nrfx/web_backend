<?php

class VisitedPagesMiddleware extends BaseMiddleware
{
    public function apply(BaseController $controller, array $context)
    {
        // записываем текущую страницу в историю посещений
        $currentUrl = urldecode($_SERVER['REQUEST_URI']);
        if (!isset($_SESSION['visited_pages'])) {
            $_SESSION['visited_pages'] = [];
        }
        array_push($_SESSION['visited_pages'], $currentUrl);
        // оставляем только последние 10
        $_SESSION['visited_pages'] = array_slice($_SESSION['visited_pages'], -10);
    }
}
