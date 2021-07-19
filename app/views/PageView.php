<?php

namespace app\views;

use core\View;

class PageView extends View
{
    protected function renderPageContent($vars = [])
    {
        $content = $this->renderTemplate('content_tpl.php', $vars);
        $vars['content'] = $content;
        $this->printPage($vars);
    }

    private function printPage($vars = [])
    {
        echo $this->renderTemplate('main_tpl.php', $vars);
    }

    public function renderCatalogPage($vars = [])
    {
        if (isset($vars['catalogItems'])) {
            $catalogView = new CatalogView();
            $vars['link'] = '/catalog/category';
            $vars['columnWidth'] = 3;
            $text = $catalogView->renderCatalogView($vars);
            $vars['title'] = 'Каталог';
            $vars['text'] = $text;
            $this->renderPageContent($vars);
        }
    }

    public function renderProductPage($vars = []){
        $productView =  new ProductView();
        $text = $productView->renderProductView($vars);
        $vars['text'] = $text;
        $this->renderPageContent($vars);
    }

    public function renderStaticPage($vars =[]){
        $this->renderPageContent($vars);
    }
}