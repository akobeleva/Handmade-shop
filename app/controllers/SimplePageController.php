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

    public function indexAction()
    {
        $this->view->renderPage('MainView.php');
    }

    public function aboutAction()
    {
        $text = $this->model->getTextByTitle('О нас');
        $content = $this->view->renderTemplate(
            'simple_page_tpl.php',
            [
                'title' => 'О нас',
                'text'  => $text[0]['text']
            ]
        );
        echo $this->view->renderTemplate(
            'main_tpl.php',
            ['content' => $content]
        );
    }

    public function contactsAction()
    {
        $text = $this->model->getTextByTitle('Контакты');
        $content = $this->view->renderTemplate(
            'simple_page_tpl.php',
            [
                'title' => 'Контакты',
                'text'  => $text[0]['text']
            ]
        );
        echo $this->view->renderTemplate(
            'main_tpl.php',
            ['content' => $content]
        );
    }
}