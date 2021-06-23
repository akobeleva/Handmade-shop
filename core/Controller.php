<?php

namespace core;

abstract class Controller
{
    public $route = [];
    public $view;
    public $layout;

    public function __construct($route)
    {
        $this->route = $route;
        $this->view = $route['controller'];
    }

    public function getView()
    {
        $viewObject = new View($this->route, $this->layout, $this->view);
        $viewObject->render();
    }
}