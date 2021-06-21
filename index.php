<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


use core\Router;

require 'autoload.php';
require 'libs/functions.php';
require 'controllers/MainController.php';
require 'controllers/AboutController.php';
require 'controllers/ContactsController.php';
session_start();

$query = rtrim($_SERVER['REQUEST_URI'], '/');
$router = new Router();

$router->add('^$', ['controller' => 'Main', 'action' => "index"]);
$router->add('(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?');
debug($router->getRoutes());

$router->dispatch($query);