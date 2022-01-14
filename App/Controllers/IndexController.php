<?php

namespace App\Controllers;

//* recurses
use MF\Model\Container;
use MF\Controller\Action;

//* models
use App\Models\Info;
use App\Models\Product;

class indexController extends Action {

    public function index()
    {
        //$this->view->data = array('text', 'test');
        $product = Container::getModel('product');

        $products = $product->getProducts();

        $this->view->data = $products;

        $this->render('index', 'layout_one');
    }

    public function about_us()
    {
        //$this->view->data = array('cellphone', 'computer');

        $info = Container::getModel('info');

        $infos = $info->getInfo();

        $this->view->data = $infos;

        $this->render('about_us', 'layout_two');
    }
}