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

        $routes['subscribe'] = array(
            'route'         =>  '/subscribe',
            'controller'    =>  'IndexController',
            'action'        =>  'subscribe'
        );

        $this->setRoutes($routes);
    }
}