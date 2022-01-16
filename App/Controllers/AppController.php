<?php

namespace App\Controllers;

use MF\Model\Container;
use MF\Controller\Action;

class AppController extends Action
{

    public function timeline()
    {
        session_start();

        if (!empty($_SESSION)) {

            $tweet = Container::getModel('Tweet');

            $tweet->__set('id_user', $_SESSION['id']);

            $tweets = $tweet->getAll();

            $this->view->tweets = $tweets;

            return $this->render('timeline');
        }

        return header('Location: /?login=error');
    }

    public function tweet()
    {
        session_start();

        if (!empty($_SESSION)) {
            $tweet = Container::getModel('Tweet');

            $tweet->__set('tweet', $_POST['tweet']);
            $tweet->__set('id_user', $_SESSION['id']);

            $tweet->save();

            return header('Location: /timeline');
        }

        return header('Location: /?login=error');
    }
}
