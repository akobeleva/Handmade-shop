<?php

namespace core;

abstract class Controller{
    public $route = [];
    public $view;

    public function __construct($route){
        $this->route = $route;
//        $this->view = $route['controller'].'View';
//        include "views/$this->view.php";
    }
}