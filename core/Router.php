<?php

namespace core;

use app\controllers\AboutController;
use app\controllers\CatalogController;
use app\controllers\ContactsController;
use app\controllers\MainController;


class Router
{
    protected static $routes = [];
    protected static $currentRoute = [];

    public function __construct()
    {
        $this->addRoute('', MainController::class, 'index');
        $this->addRoute('/about', AboutController::class, 'index');
        $this->addRoute('/contacts', ContactsController::class, 'index');
        $this->addRoute('/catalog', CatalogController::class, 'index');
    }

    public static function addRoute(
        string $url,
        string $controller,
        string $method
    ) {
        self::$routes[$url] = array(
            'controller' => $controller,
            'method'     => $method
        );
    }

    public static function matchRoute(string $incomingURL): bool
    {
        if (isset(self::$routes[$incomingURL])) {
            self::$currentRoute['url'] = $incomingURL;
            self::$currentRoute['controller']
                = self::$routes[$incomingURL]['controller'];
            self::$currentRoute['method']
                = self::$routes[$incomingURL]['method'];
            return true;
        }
        return false;
    }

    /**
     * redirect URL to the correct route
     *
     * @return void
     * */
    public static function dispatch()
    {
        $url = rtrim($_SERVER['REQUEST_URI'], '/');
        if (self::matchRoute($url)) {
            $controllerName = self::$currentRoute['controller'];
            $controller = new $controllerName();
            $methodName = self::$currentRoute['method'] . 'Action';
            $controller->$methodName();
        } else {
            http_response_code(404);
            include '../public/404.html';
        }
    }
}