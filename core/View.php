<?php

namespace core;

class View
{
    const LAYOUT = 'default';
    public $route = [];
    public $view;
    public $layout;

    public function __construct($route, $layout = '', $view = ''){
        $this->route = $route;
        $this->layout = $layout ?: self::LAYOUT;
        $this->view = $view;
    }

    public function render(){
        $file_view = "app/views/{$this->route['controller']}View.php";
        ob_start();
        if (file_exists($file_view)) {
            require $file_view;
        } else {
            echo "<p>Не найден вид <b>$file_view</b></p>";
        }
        $content = ob_get_clean();

        $file_layout = "app/views/layouts/{$this->layout}.php";
        if (file_exists($file_layout)){
            require $file_layout;
        } else {
            echo "<p>Не найден шаблон <b>$file_layout</b></p>";
        }
    }
}