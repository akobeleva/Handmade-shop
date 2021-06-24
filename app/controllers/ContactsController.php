<?php

namespace app\controllers;

use core\Controller;

class ContactsController extends Controller
{
    public function indexAction()
    {
        $this->view->render('default.php', 'ContactsView.php');
    }
}