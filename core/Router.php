<?php

namespace core;

use app\controllers\AboutController;
use app\controllers\ContactsController;
use app\controllers\MainController;


class Router
{
    protected static $routes = [];
    protected static $currentRoute = [];

    public function __construct()
    {
        $this->addRoute('', MainController::class);
        $this->addRoute('/about', AboutController::class);
        $this->addRoute('/contacts', ContactsController::class);
    }

    public static function addRoute(string $url, string $controller)
    {
        self::$routes[$url] = $controller;
    }

    public static function matchRoute(string $incomingURL): bool
    {
        foreach (self::$routes as $url => $controller) {
            if ($url == $incomingURL) {
                self::$currentRoute['url'] = $url;
                self::$currentRoute['controller'] = $controller;
                return true;
            }
        }
        return false;
    }

    /**
     * redirect URL to the correct route
     * @return void
     * */
    public static function dispatch()
    {
        $url = rtrim($_SERVER['REQUEST_URI'], '/');
        if (self::matchRoute($url)) {
            $controllerName = self::$currentRoute['controller'];
            $controller = new $controllerName();
            $controller->indexAction();
        } else {
            http_response_code(404);
            include '../public/404.html';
        }
    }
}