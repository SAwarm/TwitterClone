<?php

namespace App;

use MF\Init\Bootstrap;

class Route extends Bootstrap {

    protected function initRoutes()
    {
        $routes['home'] = array(
            'route'         =>  '/',
            'controller'    =>  'IndexController',
            'action'        =>  'index'
        );

        $routes['about_us'] = array(
            'route'         =>  '/about_us',
            'controller'    =>  'IndexController',
            'action'        =>  'about_us'
        );

        $this->setRoutes($routes);
    }
}