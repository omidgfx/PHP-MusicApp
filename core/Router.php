<?php

namespace Core;

abstract class Router
{
    public static function route()
    {

        $path = $_SERVER['PATH_INFO'] ?? '';
        $path = parse_url($path, PHP_URL_PATH);
        $path = urldecode($path);

        $path = trim($path, '/');

        $x = explode('/', $path);

        if (count($x) === 0 || $x[0] === '')
            $controllerName = 'home';
        else
            $controllerName = $x[0];


        $pathToControllerFile = 'controllers/' . $controllerName . '.php';

        $controllerParameters = [];
        if (count($x) > 1)
            $controllerParameters = array_splice($x, 1);


        if (file_exists($pathToControllerFile)) {
            # render controllers
            require_once $pathToControllerFile;

            $controllerClass = "Controllers\\" . $controllerName;
            $controllerClass::index($controllerParameters);
        } else {
            # controllers not found, we can throw an error over here
            http_response_code(404);
            echo '<H1>404 ! Not Found</H1>';
        }

    }
}