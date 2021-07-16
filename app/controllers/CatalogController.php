<?php

namespace app\controllers;

use core\Controller;
use core\View;

class CatalogController extends Controller
{
    public function __construct()
    {
        $this->view = new View();
    }

    public function indexAction($_get)
    {
        $categoryController = new CategoryController();
        $categories = $categoryController->getCategories();
        $vars['catalogItems'] = $categories;
        $this->view->renderCatalogView($vars);
    }

    public function productAction($_get)
    {
        $productController = new ProductController();
        $product = $productController->getProductById($_get['id']);
        $vars['product'] = $product[0];
        $this->view->renderProductPageView($vars);
    }
}