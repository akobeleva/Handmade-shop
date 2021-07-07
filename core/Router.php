<?php

namespace core;

use app\controllers\AboutController;
use app\controllers\CatalogController;
use app\controllers\ContactsController;
use app\controllers\MainController;


class Router
{
    protected static $routes = [];

    public function __construct()
    {
        $this->addRoute('', MainController::class, 'indexAction');
        $this->addRoute('/about', AboutController::class, 'indexAction');
        $this->addRoute('/contacts', ContactsController::class, 'indexAction');
        $this->addRoute('/catalog', CatalogController::class, 'indexAction');
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

    /**
     * redirect URL to the correct route
     *
     * @return void
     * */
    public static function dispatch()
    {
        if ($_GET) {
            $url = rtrim($_SERVER['REQUEST_URI'], $_SERVER['QUERY_STRING']);
            $url = rtrim($url, '/?');
        } else {
            $url = rtrim($_SERVER['REQUEST_URI'], '/');
        }
        if (isset(self::$routes[$url])) {
            $controllerName = self::$routes[$url]['controller'];
            $controller = new $controllerName();
            $methodName = self::$routes[$url]['method'];
            $controller->$methodName();
        } else {
            http_response_code(404);
            include '../public/404.html';
        }
    }
}