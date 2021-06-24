<?php

namespace core;

class View
{
    public $layout;

    public function render(string $layoutName, string $viewName)
    {
        $file_view = '../app/views/' . $viewName;
        ob_start();
        require_once $file_view;
        $content = ob_get_clean();

        $file_layout = '../app/views/layouts/' . $layoutName;
        require_once $file_layout;
    }
}