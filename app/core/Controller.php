<?php

namespace app\core;

use Exception;

class Controller
{
    public static function controllers($MatchedUri, $params)
    {
        [$controller, $method] = explode('@', array_values($MatchedUri)[0]);
        $controllerNamespace = CONTROLLER_PATH . $controller;
        if (!class_exists($controllerNamespace)) throw new Exception("Controller {$controller} não exist");
        $controllerInstance = new $controllerNamespace;
        if (!method_exists($controllerInstance, $method)) throw new Exception("method {$method} no exist in {$controller}");
        $controllerInstance->$method($params);
    }
}
