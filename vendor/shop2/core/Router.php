<?php

namespace shop2;

class Router
{
    //маргрти
    static $routes = [];
    //поточний маршрут який записуемо в рутс
    static $route = [];
    //добавляемо правило в масив маршрутів
    public static function add($regexp, $route = [])
    {
        self::$routes[$regexp] = $route;
    }
    public static function getRoutes()
    {
        return self::$routes;
    }
    public static function getRoute()
    {
        self::$route;
    }
    //викликае потрібний контролер
    public static function dispatch($uri)
    {
        $uri = self::removeQueryString($uri);
        if(self::matchRoute($uri)){
            //викликаемо контролерр
          $controller = 'app\controllers\\' . self::$route['prefix'] . self::$route['controller'] . 'Controller';
           if(class_exists($controller)){
               //создаемо обьект потрібного класу і передаемо в нього маршрут де е параметри
               $controllerObject = new $controller(self::$route);
                $action = self::lowerCamalCase(self::$route['action']) . 'Action';
                if(method_exists($controllerObject, $action)){
                    $controllerObject->$action();
                    $controllerObject->getView();
                }else{
                    throw new \Exception("Метод - $controller::$action", 404);
                }
           }else{
               throw new \Exception("Такого класу не існуе - $controller", 404);
           }
        }else{
            throw new \Exception("Сторінка не знайдена", 404);
        }
    }
    //Шукае співвідношеня у таблиці маршрутів
    public static function matchRoute($uri)
    {
        foreach (self::$routes as $pattern => $route) {
            if (preg_match("#{$pattern}#i", $uri, $matches)){
            foreach ($matches as $k => $v){
                if(is_string($k)){
                    $route[$k] = $v;
                }
            }
            if(empty($route['action'])){
                $route['action'] = 'index';
            }
            if(!isset($route['prefix'])){
                $route['prefix'] = '';
            }else{
                $route['prefix'] .= '\\';
            }
            $route['controller'] = self::upperCamalCase($route['controller']);
            self::$route = $route;
            return true;
            }
        }
        return false;
    }
    //CameCase
    protected static function upperCamalCase($str)
    {
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $str)));
    }
    //camelcase
    public static function lowerCamalCase($str)
    {
        return lcfirst(self::upperCamalCase($str));
    }
        //вирізае Пег параметри зі строки запросу
    protected static function removeQueryString($uri)
    {
        if($uri){
            $params = explode('&', $uri, 2);
            if(false === strpos($params[0], '=')){
                return rtrim($params[0], '/');
            }else{
                return '';
            }
        }
    }
}