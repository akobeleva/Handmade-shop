<?php

namespace core;

class View
{
    public function renderPage(string $viewName, string $templateName = 'MainTemplate.php')
    {
        $file_view = '../app/views/' . $viewName;
        ob_start();
        require_once $file_view;
        $content = ob_get_clean();

        $file_layout = '../app/views/layouts/' . $templateName;
        require_once $file_layout;
    }

    public function renderComponent(string $componentViewName, $data = null)
    {
        if (is_array($data)) {
            extract($data);
        }
        require_once '../app/views/' . $componentViewName;
    }
}