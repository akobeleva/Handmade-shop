<?php

namespace core;

use app\controllers\CatalogController;
use app\controllers\CategoryController;
use app\controllers\ProductController;
use app\controllers\SearchController;
use app\controllers\StaticPageController;
use app\controllers\SubcategoryController;


class Router
{
    protected static $routes = [];
    protected static $aliases = [];

    public function __construct()
    {
        $this->addRoute('', StaticPageController::class, 'showMainPage');
        $this->addRoute('/page', StaticPageController::class, 'showStaticPage');
        $this->addRoute('/catalog', CatalogController::class, 'showCatalogPage');
        $this->addRoute('/catalog/category', CategoryController::class, 'showCategoryPage');
        $this->addRoute('/catalog/subcategory', SubcategoryController::class, 'showSubcategoryPage');
        $this->addRoute('/catalog/product', ProductController::class, 'showProductPage');
        $this->addRoute("/search", SearchController::class, 'show');

        $this->addAlias('/about', '/page/1');
        $this->addAlias('/contacts', '/page/2');
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

    public function addAlias(string $alias, string $url){
        self::$aliases[$alias] = $url;
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
        if (isset(self::$aliases[$url])){
            $url = self::$aliases[$url];
        }
        $lastSymbol = strrchr($url, '/');
        $lastSymbol = str_replace('/', '', $lastSymbol);
        if (is_numeric($lastSymbol)) {
            $url = rtrim($url, '/' . $lastSymbol);
            $param = $lastSymbol;
        }
        if (isset(self::$routes[$url])) {
            $controllerName = self::$routes[$url]['controller'];
            $controller = new $controllerName();
            $methodName = self::$routes[$url]['method'];
            if (isset($param)) {
                $controller->$methodName($param);
            } else {
                $controller->$methodName();
            }
        } else {
            http_response_code(404);
            include '../app/views/404.html';
        }
    }
}