<?php

namespace app\views\pages;

use app\views\CatalogTableView;

class CatalogPageView extends PageView
{
    public function renderCatalogPage($vars=[]){
        $catalogView = new CatalogTableView();
        $vars['link'] = '/catalog/category';
        $vars['columnWidth'] = 3;
        $text = $catalogView->renderCatalogTableView($vars);
        $vars['title'] = 'Каталог';
        $vars['text'] = $text;
        $this->renderPageContent($vars);
    }
}