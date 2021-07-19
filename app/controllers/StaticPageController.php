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

    public function show($_get)
    {
        $this->view->render(['title' => 'MAIN']);
    }

    public function showStaticPage($id){
        $staticPage = $this->model->getStaticPageById($id);
        $vars['title'] = $staticPage[0]['title'];
        $vars['text'] = $staticPage[0]['text'];
        $this->view->renderStaticPage($vars);
    }
}