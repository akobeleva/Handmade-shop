<?php

namespace app\views\pages;

use app\views\CatalogTableView;

class CatalogPageView extends PageView
{
    public function renderCatalogPage($vars = [])
    {
        $catalogView = new CatalogTableView();
        $vars['columnWidth'] = 3;
        $text = $catalogView->renderCatalogTableView($vars);
        if (isset($vars['searchText'])) {
            $vars['title'] = 'Результаты по запросу ' . $vars['searchText'];
        } else {
            $vars['title'] = 'Каталог';
        }
        $vars['text'] = $text;
        $this->renderPageContent($vars);
    }
}