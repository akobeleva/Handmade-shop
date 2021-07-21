<?php

namespace app\views;

use core\View;

class MenuView extends View
{
    public function renderMenu($vars = [])
    {
        foreach ($vars['menuItems'] as &$item) {
            $item['link'] = "/catalog/category/" . $item['entity']->getId();
        }
        echo $this->renderTemplate('menu_tpl.php', $vars);
    }
}