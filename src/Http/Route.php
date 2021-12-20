<?php

namespace ProjectInitiator\Http;

use ProjectInitiator\Http\Request;
use ProjectInitiator\Http\Response;
use ProjectInitiator\View\View;

class Route
{
    public  static array $routes = [];
    protected $request;
    protected $response;

    
    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public static function get(string $route, callable|string|array $action)
    {
        self::setRoute('get', $route, $action);
    }

    public static function post(string $route, callable|string|array $action)
    {
        self::setRoute('post', $route, $action);
    }

    public function resolve()
    {
        $path = $this->request->path();
        $method = $this->request->method();
        $action = self::getRoute($method, $path);

        if (!array_key_exists($path, self::$routes[$method])){
            View::makeError('404');
        }

        if (is_callable($action)) {
            echo call_user_func_array($action, []);
        } elseif (is_array($action)) {
            echo call_user_func_array([new $action[0], $action[1]], []);
        } elseif (is_string($action)) {
            $controller = explode("@", $action)[0];
            $method = explode("@", $action)[1];
            echo call_user_func_array([new $controller, $method], []);
        }
    }


    private static function setRoute($method, $route, $action)
    {
        self::$routes[$method][$route] = $action;
    }

    private static function getRoute($method, $route)
    {
        return self::$routes[$method][$route] ?? false;
    }

}
