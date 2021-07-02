<?php

namespace app\controllers;

use app\models\MenuModel;
use core\Controller;
use core\View;

class MenuController extends Controller
{
    public function __construct()
    {
        $this->view = new View();
        $this->model = new MenuModel('category');
    }

    public function indexAction()
    {
        $data = $this->model->getAllRows();
        $this->view->renderComponent('MenuView.php', $data);
    }
}