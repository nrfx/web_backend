<?php

class LogoutController extends BaseController
{
    public function get(array $context)
    {
        $_SESSION['is_logged'] = false;
        header("Location: /login");
        exit;
    }
}