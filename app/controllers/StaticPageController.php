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
    }

    public function showMainPage()
    {
        $this->view->renderStaticPage(['title' => 'MAIN']);
    }

    public function showStaticPage($id)
    {
        $staticPage = StaticPageModel::getById($id);
        if (!isset($staticPage)) {
            $this->showNotFoundPage();
            return;
        }
        $vars['title'] = $staticPage->getTitle();
        $vars['text'] = $staticPage->getText();
        $this->view->renderPa($vars);
    }
}