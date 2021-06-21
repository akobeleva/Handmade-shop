<?php

namespace core;

class Router
{
    /**
     * таблица маршрутов
     * @var array
     * */
    protected static $routes = [];

    /**
     * текцщий маршрут
     * @var array
     * */
    protected static $route = [];

    /**
     * добавляет маршрут в таблицу маршрутов
     * @param string $regexp регулярное выражение маршрута
     * @param array $route маршрут (controller, action, [params])
     * */
    public static function add(string $regexp, array $route = []){
        self::$routes[$regexp] = $route;
    }

    /**
     * возвращает таблицу маршрутов
     * @return array
     * */
    public static function getRoutes(): array{
        return self::$routes;
    }

    /**
     * возвращает текущий маршрут (controller, action, [params])
     * @return array
     * */
    public static function getRoute(): array{
        return self::$route;
    }

    /**
     * ищет URL в таблице маршрутов
     * @param string $url входящий URL
     * @return boolean
     * */
    public static function matchRoute(string $url): bool{
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
                self::$route = $route;
                return true;
            }
        return false;
    }

    /**
     * перенаправляет URL по корректному маршруту
     * @param string $url входящий URL
     * @return void
     * */
    public static function dispatch(string $url){
        if (self::matchRoute($url)) {
            $controller = 'controllers\\'.self::upperCamelCase(self::$route['controller']).'Controller';
            if (class_exists($controller)) {
                $constructorObj = new $controller();
                $action = self::lowerCamelCase(self::$route['action']) . 'Action';
                if (method_exists($constructorObj, $action)) {
                    $constructorObj->$action();
                } else {
                    echo "Метод <b> $controller::$action </b> не найден";
                }
            } else {
                echo "Контролллер <b> $controller </b> не найден";
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

    public function run(){
        echo 'start router';
    }

}