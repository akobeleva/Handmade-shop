<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


use core\Router;

require 'autoload.php';
require '../libs/functions.php';
session_start();

$query = rtrim($_SERVER['REQUEST_URI'], '/');
$router = new Router();

$router->addRoute('^$', ['controller' => 'Main', 'action' => "index"]);
$router->addRoute('(?P<controller>[a-z-]+)/?(?P<>[a-z-]+)?');

$router->dispatch($query);