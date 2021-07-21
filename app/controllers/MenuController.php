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
        $menuItems = [];
        foreach ($categories as $category){
            $menuItems[$category->getId()]['entity'] = $category;
        }
        $vars['menuItems'] = $menuItems;
        $this->view->renderMenu($vars);
    }
}