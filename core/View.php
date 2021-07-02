<?php

namespace core;

class View
{
    public $layout;

    public function renderPage(string $layoutName, string $viewName, $data = null)
    {
        if (is_array($data)) {
            extract($data);
        }
        $file_view = '../app/views/' . $viewName;
        ob_start();
        require_once $file_view;
        $content = ob_get_clean();

        $file_layout = '../app/views/layouts/' . $layoutName;
        require_once $file_layout;
    }

    public function renderComponent(string $componentViewName)
    {
        require_once '../app/views/' . $componentViewName;
    }
}