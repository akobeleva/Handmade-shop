<?php
spl_autoload_register(function ($class) {
    $root = __DIR__.DIRECTORY_SEPARATOR;
    $file = $root . str_replace('\\', '/', $class) . '.php';

    // if the file exists, require it
    if (file_exists($file)) {
        require_once $file;
    }
});