<?php

namespace app\controllers;

use app\models\SimplePageModel;
use core\Controller;
use app\views\PageView;

class SimplePageController extends Controller
{
    public function __construct()
    {
        $this->view = new PageView();
        $this->model = new SimplePageModel();
    }

    public function show($_get)
    {
        $this->view->render(['title' => 'MAIN']);
    }

    public function aboutAction($_get)
    {
        $text = $this->model->getTextByTitle('О нас');
        $vars['title'] = 'О нас';
        $vars['text'] = $text[0]['text'];
        $this->view->render($vars);
    }

    public function contactsAction($_get)
    {
        $text = $this->model->getTextByTitle('Контакты');
        $vars['title'] = 'Контакты';
        $vars['text'] = $text[0]['text'];
        $this->view->render($vars);
    }
}