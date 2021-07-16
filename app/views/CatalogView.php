<?php

namespace app\views;

use core\View;

class CatalogView extends View
{
    public function render($vars = [])
    {
        foreach ($vars['catalogItems'] as &$item) {
            $cardView = new CardView();
            $item['link'] = '/catalog/category';
            $item['cardBody'] = $cardView->renderBody($item);
            $item['card'] = $cardView->renderCard($item);
        }
        $vars['columnWidth'] = 3;
        $catalog = $this->renderTemplate('catalog_tpl.php', $vars);
        $vars['text'] = $catalog;
        $vars['title'] = 'Каталог';
        $pageContentView = new PageContentView();
        $pageContentView->render($vars);
    }
}