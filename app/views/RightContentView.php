<?php

namespace app\views;

use core\View;

class RightContentView extends View
{
    public function render($vars = [])
    {
        $rightContent = $this->renderTemplate('catalog_tpl.php', $vars);
        $vars['rightContent'] = $rightContent;
        $leftMenuView = new LeftMenuView();
        $leftMenuView->render($vars);
    }
}