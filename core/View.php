<?php

namespace core;

define('VIEW_ROOT', '../app/views/');

abstract class View
{
    protected function renderTemplate(string $templateName, $vars = [])
    {
        if (is_array($vars)) {
            extract($vars);
        }
        ob_start();
        if (file_exists(VIEW_ROOT . 'templates/' . $templateName)) {
            require VIEW_ROOT . 'templates/' . $templateName;
        } else {
            require VIEW_ROOT . $templateName;
        }
        return ob_get_clean();
    }

    public function render($vars = [])
    {
    }
}