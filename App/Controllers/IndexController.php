<?php

namespace App\Controllers;

//* recurses
use MF\Model\Container;
use MF\Controller\Action;

class indexController extends Action
{

    public function index()
    {
        $this->view->login = isset($_GET['login']) ? $_GET['login'] : '';

        $this->render('index');
    }

    public function subscribe()
    {
        $this->view->user = array(
            'name'       =>  NULL,
            'email'      =>  NULL,
            'password'   =>  NULL,
        );

        $this->view->errorRegister = false;

        $this->render('subscribe');
    }

    public function register()
    {
        $user = Container::getModel('User');

        $user->__set('name', $_POST['name']);
        $user->__set('email', $_POST['email']);
        $user->__set('password', md5($_POST['password']));

        if (
            $user->validationRegister() &&
            count($user->getUserEmail()) <= 0
        ) {

            $user->store();

            return $this->render('register');
        }

        $this->view->user = array(
            'name'       =>  $_POST['name'],
            'email'      =>  $_POST['email'],
            'password'   =>  $_POST['password'],
        );

        $this->view->errorRegister = true;

        return $this->render('subscribe');
    }
}
