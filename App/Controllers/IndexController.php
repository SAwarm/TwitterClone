<?php

namespace App\Controllers;

//* recurses
use MF\Model\Container;
use MF\Controller\Action;

class indexController extends Action {

    public function index()
    {
        $this->render('index');
    }
}