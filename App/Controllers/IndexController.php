<?php

namespace App\Controllers;

//* recurses

use App\Connection;
use MF\Model\Container;
use MF\Controller\Action;

class indexController extends Action {

    public function index()
    {
        $this->render('index');
    }

    public function subscribe()
    {
        $this->render('subscribe');
    }

    public function register()
    {
       $user = Container::getModel('User');

       $user->__set('name', $_POST['name']);
       $user->__set('email', $_POST['email']);
       $user->__set('password', $_POST['password']);

       if ($user->validationRegister()) {

            if (count($user->getUserEmail()) <= 0) {
                $user->store();
                
                return $this->render('register');
            }
       }
    }
}