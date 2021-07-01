<?php


namespace app\controllers;


use core\Controller;

class CatalogController extends Controller
{
    public function indexAction()
    {
        $this->view->render('default.php', 'CatalogView.php');
    }
}