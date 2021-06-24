<?php

namespace core;

class Router
{
    protected static $routes = [];
    protected static $currentRoute = [];

    public static function addRoute(string $route, array $handler = [])
    {
        self::$routes[$route] = $handler;
    }

    public static function getRoutes(): array
    {
        return self::$routes;
    }

    public static function getCurrentRoute(): array
    {
        return self::$currentRoute;
    }

    /**
     * find URL in route's table
     * @param string $url incoming URL
     * @return bool
     * */
    public static function matchRoute(string $url): bool
    {
        foreach (self::$routes as $pattern => $route)
            if (preg_match("#$pattern#i", $url, $matches)) {
                foreach ($matches as $k => $v) {
                    if (is_string(($k))) {
                        $route[$k] = $v;
                    }
                }
                if (!isset($route['action'])) {
                    $route['action'] = 'index';
                }
                $route['controller'] = self::upperCamelCase($route['controller']);
                self::$currentRoute = $route;
                return true;
            }
        return false;
    }

    /**
     * redirect URL to the correct route
     * @param string $url incoming URL
     * @return void
     * */
    public static function dispatch(string $url)
    {
        if (self::matchRoute($url)) {
            $controller = 'app\\controllers\\' . self::$currentRoute['controller'] . 'Controller';
            if (class_exists($controller)) {
                $controllerObj = new $controller(self::$currentRoute);
                $action = self::lowerCamelCase(self::$currentRoute['action']) . 'Action';
                if (method_exists($controllerObj, $action)) {
                    $controllerObj->$action();
                    $controllerObj->getView();
                } else {
                    echo "Method <b> $controller::$action </b> not found";
                }
            } else {
                echo "Controller <b> $controller </b> not found";
            }
        } else {
            http_response_code(404);
            include 'public/404.html';
        }
    }

    /**
     * приводит к корректному названию класса
     * @param string $name входяще имя класса
     * @return string
     **/
    protected static function upperCamelCase(string $name): string
    {
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $name)));
    }

    /**
     * приводит к корректному названию метода
     * @param string $name входяще имя метода
     * @return string
     **/
    protected static function lowerCamelCase(string $name): string
    {
        return lcfirst(self::upperCamelCase($name));
    }

    public function run()
    {
        echo 'start router';
    }

}