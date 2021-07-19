<?php

namespace app\views;

use core\View;

class PageView extends View
{
    public function render($vars = [])
    {
        $content = $this->renderTemplate('content_tpl.php', $vars);
        $vars['content'] = $content;
        $this->renderMainView($vars);
    }

    private function renderMainView($vars = [])
    {
        echo $this->renderTemplate('main_tpl.php', $vars);
    }
}