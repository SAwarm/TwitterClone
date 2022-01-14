<?php

namespace App\Controllers;

//* recurses
use MF\Model\Container;
use MF\Controller\Action;

class AuthController extends Action {

    public function authenticate()
    {
        $user = Container::getModel('User');
        
        $user->__set('email', $_POST['email']);
        $user->__set('password', $_POST['password']);

        $return = $user->authenticate();

        if ($return) {
            echo "Authenticate";
            return;
        }

        header('Location: ../?login=error');
    }
}