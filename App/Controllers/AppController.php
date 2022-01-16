<?php

namespace App\Controllers;

use MF\Model\Container;
use MF\Controller\Action;

class AppController extends Action
{

    public function timeline()
    {
        session_start();

        $this->validationAuth();

        $tweet = Container::getModel('Tweet');

        $tweet->__set('id_user', $_SESSION['id']);

        $tweets = $tweet->getAll();

        $this->view->tweets = $tweets;

        return $this->render('timeline');
    }

    public function tweet()
    {
        session_start();

        $this->validationAuth();
        
        $tweet = Container::getModel('Tweet');

        $tweet->__set('tweet', $_POST['tweet']);
        $tweet->__set('id_user', $_SESSION['id']);

        $tweet->save();

        return header('Location: /timeline');
    }

    public function validationAuth()
    {
        if (!empty($_SESSION)) {
            return true;
        }

        return header('Location: /?login=error');
    }
}
