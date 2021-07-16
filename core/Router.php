<?php

namespace core;

use app\controllers\CatalogController;
use app\controllers\CategoryController;
use app\controllers\SearchController;
use app\controllers\SimplePageController;


class Router
{
    protected static $routes = [];

    public function __construct()
    {
        $this->addRoute('', SimplePageController::class, 'indexAction');
        $this->addRoute('/about', SimplePageController::class, 'aboutAction');
        $this->addRoute('/contacts', SimplePageController::class, 'contactsAction');
        $this->addRoute('/catalog', CatalogController::class, 'indexAction');
        $this->addRoute('/catalog/category', CategoryController::class, 'categoryAction');
        $this->addRoute('/catalog/product', CatalogController::class, 'productAction');
        $this->addRoute("/search", SearchController::class, 'indexAction');
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
            $controller->$methodName($_GET);
        } else {
            http_response_code(404);
            include '../app/views/404.html';
        }
    }
}