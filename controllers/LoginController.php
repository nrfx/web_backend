<?php

class LoginController extends TwigBaseController
{
    public function get(array $context)
    {
        echo $this->twig->render('login.twig', $context);
    }

    public function post(array $context)
    {
        $login = $_POST['login'];
        $password = $_POST['password'];

        if ($login === 'admin' && $password === 'admin') {
            $_SESSION['is_logged'] = true;
            header('Location: /');
            exit;
        } else {
            $context['error'] = 'Неверный логин или пароль';
            echo $this->twig->render('login.twig', $context);
        }
    }
}