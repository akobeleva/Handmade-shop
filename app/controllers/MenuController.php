<?php

namespace app\controllers;

use core\Controller;
use core\View;

class MenuController extends Controller
{
    public function __construct()
    {
        $this->view = new View();
    }

    public function show($_get)
    {
        $categoryController = new CategoryController();
        $categories = $categoryController->getCategories();
        echo $this->view->renderTemplate(
            'menu_view.php',
            ['menuItems' => $categories]
        );
    }
}