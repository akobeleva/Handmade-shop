<?php

namespace app\views;

use core\View;

class ProductView extends View
{
    public function render($vars = []){
        $text = $this->renderTemplate('product_view.php', $vars);
        $vars['text'] = $text;
        $pageContentView = new PageContentView();
        $pageContentView->render($vars);
    }
}