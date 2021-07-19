<?php

namespace app\controllers;

use app\models\StaticPageModel;
use core\Controller;
use app\views\PageView;

class StaticPageController extends Controller
{
    public function __construct()
    {
        $this->view = new PageView();
        $this->model = new StaticPageModel();
    }

    public function showMainPage()
    {
        $this->view->renderStaticPage(['title' => 'MAIN']);
    }

    public function showStaticPage($id){
        $staticPage = $this->model->getStaticPageById($id);
        if (!isset($staticPage)){
            $this->showNotFoundPage();
            return;
        }
        $vars['title'] = $staticPage[0]['title'];
        $vars['text'] = $staticPage[0]['text'];
        $this->view->renderStaticPage($vars);
    }
}