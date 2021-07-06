<?php

namespace app\controllers;

use app\models\CatalogModel;
use core\Controller;
use core\View;

class CatalogController extends Controller
{
    public function __construct()
    {
        $this->view = new View();
        $this->model = new CatalogModel();
    }

    public function indexAction()
    {
        $data = $this->model->getAllRows();
        $this->view->renderPage('CatalogView.php', $data);
    }
}