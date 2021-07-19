<?php

namespace app\controllers;

use app\views\CatalogView;
use core\Controller;

class CatalogController extends Controller
{
    public function __construct()
    {
        $this->view = new CatalogView();
    }

    public function showCatalogPage($_get)
    {
        $categoryController = new CategoryController();
        $categories = $categoryController->getCategories();
        $vars['catalogItems'] = $categories;
        $this->view->render($vars);
    }
}