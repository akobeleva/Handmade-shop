<?php

namespace app\controllers;

use core\Controller;
use core\View;

class ContactsController extends Controller
{

    public function __construct()
    {
        $this->view = new View();
    }

    public function indexAction()
    {
        $this->view->render('default.php', 'ContactsView.php');
    }
}