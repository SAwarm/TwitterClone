<?php

namespace App\Controllers;

//* recurses
use MF\Model\Container;
use MF\Controller\Action;

class AuthController extends Action
{

    public function authenticate()
    {
        $user = Container::getModel('User');

        $user->__set('email', $_POST['email']);
        $user->__set('password', $_POST['password']);

        $return = $user->authenticate();

        if ($return) {
            session_start();

            $_SESSION['id'] = $user->__get('id');
            $_SESSION['name'] = $user->__get('name');

            return header('Location: /timeline');
        }

        return header('Location: /?login=error');
    }

    public function logout()
    {
        session_start();

        session_destroy();

        return header('Location: /');
    }
}
