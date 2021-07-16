<?php

namespace app\views;

use core\View;

class MenuView extends View
{
    public function render($vars = [])
    {
        echo $this->renderTemplate('menu_view.php', $vars);
    }
}