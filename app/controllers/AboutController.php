<?php

namespace app\controllers;

use core\Controller;


class AboutController extends Controller
{
    public function indexAction()
    {
        $this->view->render('default.php', 'AboutView.php');
    }
}