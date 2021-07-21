<?php

namespace app\views\pages;

use app\views\CatalogView;

class CatalogPageView extends PageView
{
    public function renderCatalogPage($vars=[]){
        $catalogView = new CatalogView();
        $vars['link'] = '/catalog/category';
        $vars['columnWidth'] = 3;
        $text = $catalogView->renderCatalogView($vars);
        $vars['title'] = 'Каталог';
        $vars['text'] = $text;
        $this->renderPageContent($vars);
    }
}