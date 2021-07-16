<?php

namespace app\controllers;

use app\views\MenuView;
use core\Controller;

class MenuController extends Controller
{
    public function __construct()
    {
        $this->view = new MenuView();
    }

    public function show($_get)
    {
        $categoryController = new CategoryController();
        $categories = $categoryController->getCategories();
        $vars['menuItems'] = $categories;
        $this->view->render($vars);
    }
}