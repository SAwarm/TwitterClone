<?php

namespace MF\Controller;

abstract class Action {

    protected $view;

    public function __construct()
    {
        $this->view = new \stdClass;
    }

    public function render($view, $layout)
    {
        $this->view->page = $view;

        if (file_exists("./../App/Views/".$layout.".phtml")) {
            return require_once "./../App/Views/".$layout.".phtml";
        }

        return $this->content();
    }

    protected function content()
    {
        $actual_class = get_class($this);

        $actual_class = str_replace('App\\Controllers\\', '', $actual_class);

        $actual_class = strtolower(str_replace('Controller', '', $actual_class));

        require_once "./../App/Views/".$actual_class."/".$this->view->page.".phtml";
    }
}