<?php

namespace app\controllers;

use app\views\PageView;
use core\Controller;

class CatalogController extends Controller
{
    public function __construct()
    {
        $this->view = new PageView();
    }

    public function showCatalogPage($_get)
    {
        $categoryController = new CategoryController();
        $categories = $categoryController->getCategories();
        $vars['catalogItems'] = $categories;
        $this->view->renderCatalogPage($vars);
    }
}