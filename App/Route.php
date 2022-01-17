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

        $routes['register'] = array(
            'route'         =>  '/register',
            'controller'    =>  'IndexController',
            'action'        =>  'register'
        );

        $routes['authenticate'] = array(
            'route'         =>  '/authenticate',
            'controller'    =>  'AuthController',
            'action'        =>  'authenticate'
        );

        $routes['timeline'] = array(
            'route'         =>  '/timeline',
            'controller'    =>  'AppController',
            'action'        =>  'timeline'
        );

        $routes['logout'] = array(
            'route'         =>  '/logout',
            'controller'    =>  'AuthController',
            'action'        =>  'logout'
        );

        $routes['tweet'] = array(
            'route'         =>  '/tweet',
            'controller'    =>  'AppController',
            'action'        =>  'tweet'
        );

        $routes['who_to_follow'] = array(
            'route'         =>  '/who_to_follow',
            'controller'    =>  'AppController',
            'action'        =>  'who_to_follow'
        );

        $routes['action'] = array(
            'route'         =>  '/action',
            'controller'    =>  'AppController',
            'action'        =>  'action'
        );

        $this->setRoutes($routes);
    }
}