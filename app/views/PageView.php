<?php

namespace app\views;

use core\View;

class PageView extends View
{
    public function renderPageContent($vars = [])
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
            $text = $catalogView->renderCatalogView($vars);
            $vars['title'] = 'Каталог';
            $vars['text'] = $text;
            $this->renderPageContent($vars);
        }
    }
}