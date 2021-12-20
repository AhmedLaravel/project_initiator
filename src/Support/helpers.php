<?php

use ProjectInitiator\View\View;
use ProjectInitiator\Application;
use Dotenv\Dotenv;

if(!function_exists("env")){
    function env($key, $default = null){
        return $_ENV[$key] ?? value($default);
    }
}


if(!function_exists("value")){
    function value($value){
        return ($value instanceof Closure) ? $value() : $value;
    }
}

if(!function_exists("base_path")){
    function base_path($path = ''){
        return dirname(__DIR__) . '/../' . $path;
    }
}

if(!function_exists("view_path")){
    function view_path($path = ''){
        return base_path('views/') . $path . "/";
    }
}

if(!function_exists("view")){
    function view($view, $params = []){
        return View::make($view, $params) ;
    }
}

if(!function_exists("app")){
    function app(){
        static $instance = null;

        if(!$instance)
        $instance = new Application();
        return $instance;
    }
}

if(!function_exists("load_env")){
    function load_env(){
        return Dotenv::createImmutable(base_path())->load();
    }
}