<?php

namespace App\Controllers;

use MF\Controller\Action;
use MF\Model\Container;

class ComponentsController extends Action
{
    public function getUserInfo()
    {
        $user = Container::getModel('User');

        $user->__set('id', $_SESSION['id']);

        $this->view->infoUser = $user->getInfoUser();

        $this->view->totalTweet = $user->getTotalTweet();

        $this->view->totalFollow = $user->getTotalFollows();

        $this->view->totalToFollow = $user->getTotalToFollows();
    }

    public function getUserPanel()
    {
        $this->getUserInfo();

        $this->render('userPanel');
    }
}
