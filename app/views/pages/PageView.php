<?php

namespace app\views\pages;

use core\View;

class PageView extends View
{
    public function renderPageContent($vars = [])
    {
        $content = $this->renderTemplate('content_tpl.php', $vars);
        $vars['content'] = $content;
        $this->printPage($vars);
    }

    protected function printPage($vars = [])
    {
        echo $this->renderTemplate('main_tpl.php', $vars);
    }

    public function renderNotFoundPage()
    {
        $vars = [];
        $vars['text'] = $this->renderTemplate('404.html', $vars);
        $this->renderPageContent($vars);
    }

    public function renderMessages($vars = []){
        $text = $this->renderTemplate('messages_tpl.php', $vars);
        $vars['text'] = $text;
        $this->renderPageContent($vars);
    }
}