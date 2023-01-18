<?php

namespace app\core;

class Route
{
    const CONTROLLER_NAMESPACE = 'app\controllers\\';

    public static function init(){
        $requestURI = $_SERVER['REQUEST_URI'];
        $requestUriWithoutSearch = explode('?', $requestURI)[0];    //remove search params
        $requestUriWithoutSearch = rtrim($requestUriWithoutSearch, '/');
        $pathComponents = explode('/', $requestUriWithoutSearch);
        $pathComponents = array_slice($pathComponents, 1);  //remove ever empty 0 element
        if(count($pathComponents)>2 ){   //our algorithm await less then 3 params
            self::notFound();
        }
        $controllerName = 'index';
        if(!empty($pathComponents[0])){
            $controllerName = strtolower($pathComponents[0]);
        }
        $actionName = 'index';
        if(!empty($pathComponents[1])){
            $actionName = strtolower($pathComponents[1]);
        }
        $controllerClass = self::CONTROLLER_NAMESPACE.ucfirst($controllerName).'Controller';
        if(!class_exists($controllerClass)){
            self::notFound();
        }
        $controller = new $controllerClass();
        if(!method_exists($controller, $actionName)){
            self::notFound();
        }
        //$controller->$actionName();
        self::callAction($controller, $actionName);
    }

    public static function notFound(){
        http_response_code(404);
        exit();
    }

    private static function callAction(indexable $controller,$action){
        $controller->$action();
    }

    public static function url(string $controller = null, string $action = null)
    {
        $controller = $controller ?? 'index';
        $action = $action ?? 'index';
        return "/{$controller}/{$action}";
    }
}





























