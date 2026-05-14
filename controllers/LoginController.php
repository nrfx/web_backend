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

        // проверяем по таблице users в БД
        $query = $this->pdo->prepare("SELECT * FROM users WHERE username = :username AND password = :password");
        $query->bindValue("username", $login);
        $query->bindValue("password", $password);
        $query->execute();
        $user = $query->fetch();

        if ($user) {
            $_SESSION['is_logged'] = true;
            header('Location: /');
            exit;
        } else {
            $context['error'] = 'Неверный логин или пароль';
            echo $this->twig->render('login.twig', $context);
        }
    }
}