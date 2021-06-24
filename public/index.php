<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use core\Router;

require_once 'autoload.php';
require_once '../libs/functions.php';
session_start();

$router = new Router();
$router->dispatch();