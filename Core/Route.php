<?php

namespace Core;

use function Composer\Autoload\includeFile;

class Route
{
    public $controllerName;
    public $actionName;

    static function start()
    {
        $controllerName = 'main';
        $actionName = 'index';
        $routes = explode('/', $_SERVER['REQUEST_URI']);

        if (!empty($routes[1])) {
            $controllerName = $routes[1];
        }
        if (!empty($routes[2])) {
            $actionName = $routes[2];
        }

        if ($controllerName == 'public' and $actionName == 'css') {
        header('Location: http:/blog.com:8080/public/css/blog-style.css');
//            include 'public/css/blog-style.css';
        }


        $modelName = ucfirst($controllerName) . 'Model';
        $controllerName = ucfirst($controllerName) . 'Controller';
        $actionName = 'action' . ucfirst($actionName);

        $modelFile = ucfirst($modelName) . '.php';
        $modelPath = '../Application/Models/' . $modelFile;

        if (file_exists($modelPath)) {
            include '../Application/Models/' . $modelFile;
        }

        $controllerFile = ($controllerName) . '.php';
        $controllerPath = '../Application/Controllers/' . $controllerFile;
        if (file_exists($controllerPath) or $controllerName == 'public') {
            include '../Application/Controllers/' . $controllerFile;
        } else {
            Route::errorPage404();
        }
        $controllerName = "Application\Controllers\\" . $controllerName;
        $controller = new $controllerName;
        $action = $actionName;

        if (method_exists($controller, $action)) {
            $controller->$action();
        } else {
            Route::errorPage404();
        }
    }

    public static function errorPage404()
    {
        $host = 'http://' . $_SERVER['HTTP_HOST'] . '/';
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        header('Location:' . $host . 'error404');
    }
}