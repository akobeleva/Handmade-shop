<?php

namespace app\views;

use core\View;

class LeftMenuView extends View
{
    public function render($vars = [])
    {
        $leftMenu = $this->renderTemplate('left_menu_tpl.php', $vars);
        $vars['text'] = $leftMenu;
        $pageContentView = new PageView();
        $pageContentView->render($vars);
    }
}