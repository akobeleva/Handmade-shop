<?php

namespace app\controllers;

use app\models\CategoryModel;
use core\Controller;
use core\View;

class MenuController extends Controller
{
    public function __construct()
    {
        $this->view = new View();
        $this->model = new CategoryModel();
    }

    public function indexAction($_get)
    {
        $data = $this->model->getCategoriesByWeight();
        echo $this->view->renderTemplate(
            'menu_view.php',
            ['menuItems' => $data]
        );
    }
}