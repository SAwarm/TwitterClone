<?php

namespace App\Controllers;

use MF\Model\Container;
use MF\Controller\Action;

class AppController extends Action
{

    public function timeline()
    {
        $this->validationAuth();

        $tweet = Container::getModel('Tweet');

        $tweet->__set('id_user', $_SESSION['id']);

        $tweets = $tweet->getAll();

        $this->view->tweets = $tweets;

        return $this->render('timeline');
    }

    public function tweet()
    {
        $this->validationAuth();

        $tweet = Container::getModel('Tweet');

        $tweet->__set('tweet', $_POST['tweet']);
        $tweet->__set('id_user', $_SESSION['id']);

        $tweet->save();

        return header('Location: /timeline');
    }

    public function who_to_follow()
    {
        $this->validationAuth();

        $searchFor = !empty($_GET['searchFor']) ? $_GET['searchFor'] : '';

        $users = array();

        if (!empty($searchFor)) {
            $user = Container::getModel('User');

            $user->__set('name', $searchFor);

            $users = $user->getAll();
        }

        $this->view->users = $users;

        $this->render('who_to_follow');
    }

    public function validationAuth()
    {
        session_start();

        if (!empty($_SESSION)) {
            return true;
        }

        return header('Location: /?login=error');
    }
}
