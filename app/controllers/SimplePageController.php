<?php

namespace app\controllers;

use app\models\SimplePageModel;
use core\Controller;
use core\View;

class SimplePageController extends Controller
{
    public function __construct()
    {
        $this->view = new View();
        $this->model = new SimplePageModel();
    }

    public function indexAction($_get)
    {
        $this->view->renderSimplePageView(['title'=>'MAIN']);
    }

    public function aboutAction($_get)
    {
        $text = $this->model->getTextByTitle('О нас');
        $vars['title'] = 'О нас';
        $vars['text'] = $text[0]['text'];
        $this->view->renderSimplePageView($vars);
    }

    public function contactsAction($_get)
    {
        $text = $this->model->getTextByTitle('Контакты');
        $vars['title'] = 'Контакты';
        $vars['text'] = $text[0]['text'];
        $this->view->renderSimplePageView($vars);
    }
}