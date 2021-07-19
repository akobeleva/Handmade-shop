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

    public function showMenu()
    {
        $categoryController = new CategoryController();
        $categories = $categoryController->getCategories();
        if (!isset($categories)){
            $this->showNotFoundPage();
            return;
        }
        $vars['menuItems'] = $categories;
        $this->view->renderMenu($vars);
    }
}