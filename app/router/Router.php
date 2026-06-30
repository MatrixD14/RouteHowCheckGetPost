<?php

namespace app\router;

use app\core\Controller;
use Exception;

class Router
{
    private static  function routes()
    {
        return require_once __DIR__ . '/routers.php';
    }
    private static function exactMatchUriInArrayRoutes($uri, $routes)
    {
        if (array_key_exists($uri, $routes)) return [$uri => $routes[$uri]];
        return [];
    }
    private static function regularExpressionMAtchRoutes($uri, $routes)
    {
        return array_filter($routes, function ($value) use ($uri) {
            $regex = str_replace('/', '\/', ltrim($value, '/'));
            return preg_match("/^$regex$/", ltrim($uri, '/'));
        }, ARRAY_FILTER_USE_KEY);
    }
    private static function param($MatchedUri, $uri)
    {
        if (empty($MatchedUri)) return [];
        $MatchedInParams = array_keys($MatchedUri)[0];
        return  array_diff(
            $uri,
            explode('/', ltrim($MatchedInParams, '/'))
        );
    }
    private static function paramsFormat($uri, $params)
    {
        $paramsData = [];
        foreach ($params as $index => $param) {
            $paramsData[$uri[$index - 1]] = $param;
        }
        return $paramsData;
    }
    private static function routers()
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $routes = self::routes();
        $MatchedUri = self::exactMatchUriInArrayRoutes($uri, $routes);
        $params = [];
        if (empty($MatchedUri)) {
            $MatchedUri = self::regularExpressionMAtchRoutes($uri, $routes);
            $uri = explode('/', ltrim($uri, '/'));
            $params = self::param($MatchedUri, $uri);
            $params = self::paramsFormat($uri, $params);
        }
        if (!empty($MatchedUri)) {
            Controller::controllers($MatchedUri, $params);
            return;
        }
        throw new Exception("algo de errado");
    }
    public static function execut()
    {
        self::routers();
    }
}
