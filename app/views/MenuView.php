<?php

namespace app\views;

use core\View;

class MenuView extends View
{
    public function renderMenu($vars = [])
    {
        echo $this->renderTemplate('menu_tpl.php', $vars);
    }
}