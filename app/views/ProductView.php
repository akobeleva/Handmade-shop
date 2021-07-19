<?php

namespace app\views;

use core\View;

class ProductView extends View
{
    public function renderProductView($vars = [])
    {
        return $this->renderTemplate('product_tpl.php', $vars);
    }
}