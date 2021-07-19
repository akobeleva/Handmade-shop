<?php

namespace app\views;

use core\View;

class MenuView extends View
{
    public function renderMenu($vars = [])
    {
        foreach ($vars['menuItems'] as &$item) {
            $item['link'] = "/catalog/category/?id=" . $item['id'];
        }
        echo $this->renderTemplate('menu_tpl.php', $vars);
    }
}