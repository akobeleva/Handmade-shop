<?php

namespace app\controllers;

use core\Controller;
use core\View;

class MainController extends Controller
{
    public function __construct()
    {
        $this->view = new View();
    }

    public function indexAction()
    {
        $this->view->renderPage('MainView.php');
    }
}