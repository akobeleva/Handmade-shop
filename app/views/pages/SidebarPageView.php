<?php

namespace app\views\pages;

class SidebarPageView extends PageView
{
    public function renderPageContent($vars = [])
    {
        $content = $this->renderTemplate('sidebar_tpl.php', $vars);
        $vars['content'] = $content;
        $this->printPage($vars);
    }
}