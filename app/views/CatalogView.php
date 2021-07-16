<?php

namespace app\views;

use core\View;

class CatalogView extends View
{
    public function render($vars = [])
    {
        $catalog = $this->renderTemplate('catalog_tpl.php', $vars);
        $vars['text'] = $catalog;
        $vars['title'] = 'Каталог';
        $pageContentView = new PageContentView();
        $pageContentView->render($vars);
    }
}