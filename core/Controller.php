<?php

namespace core;

abstract class Controller
{
    protected $view;
    protected $model;

    public function showNotFoundPage(){
        http_response_code(404);
        $this->view->renderNotFoundPage();
    }
}