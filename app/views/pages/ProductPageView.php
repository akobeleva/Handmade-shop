<?php

namespace app\views\pages;

class ProductPageView extends PageView
{
    public function renderPageContent($vars = [])
    {
        $content = $this->renderTemplate('product_tpl.php', $vars);
        $vars['content'] = $content;
        $this->printPage($vars);
    }
}