<?php

namespace app\views;

use core\View;

class ProductView extends View
{
    public function render($vars = []){
        $text = $this->renderTemplate('product_tpl.php', $vars);
        $vars['text'] = $text;
        $pageContentView = new PageView();
        $pageContentView->render($vars);
    }
}