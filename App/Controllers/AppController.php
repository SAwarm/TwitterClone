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
            return $this->render('timeline');
        }

        return header('Location: /?login=error');
    }
}
