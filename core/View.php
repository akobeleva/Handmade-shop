<?php

namespace core;

define('VIEW_ROOT', '../app/views/');

class View
{
    public function renderPage(string $viewName, $data = null, string $templateName = 'main_tpl.php')
    {
        if (is_array($data)) {
            extract($data);
        }
        $file_view = VIEW_ROOT . $viewName;
        ob_start();
        require_once $file_view;
        $content = ob_get_clean();
        $file_layout = VIEW_ROOT . 'templates/' . $templateName;
        require_once $file_layout;
    }

    public function renderComponent(string $componentViewName, $data = null)
    {
        if (is_array($data)) {
            extract($data);
        }
        require_once VIEW_ROOT . $componentViewName;
    }

    public function renderTemplate(string $templateName, $vars = []){
        extract($vars);
        ob_start();
        require_once VIEW_ROOT . 'templates/'. $templateName;
        $content = ob_get_clean();
        return $content;
    }
}