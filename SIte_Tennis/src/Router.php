<?php

namespace App;

use App\Controller\HomeController;
use App\Controller\ProductsController;
use App\Controller\UserController;

class Router
{
    private const ROUTES = [
        '/'              => HomeController::class . '@index',
        '/home'          => HomeController::class . '@index',
        '/contact'       => HomeController::class . '@contact',
        '/register'      => UserController::class . '@register',
        '/login'         => UserController::class . '@login',
        '/logout'        => UserController::class . '@logout',
        '/products'      => ProductsController::class . '@products'
    ];

    public static function handleRequest()
    {
        $uri = $_SERVER['REQUEST_URI'];
        if (isset(self::ROUTES[$uri])) {
            $route = self::ROUTES[$uri];
            list($controller, $method) = explode('@', $route);
            self::executeControllerMethod($controller, $method);
        } else {
            self::renderErrorPage(404);
        }
    }

    private static function executeControllerMethod($controller, $method)
    {
        $controllerInstance = new $controller();
        if (method_exists($controllerInstance, $method)) {
            $controllerInstance->$method();
        } else {
            self::renderErrorPage(404);
        }
    }

    private static function renderErrorPage($errorCode)
    {
        http_response_code($errorCode);
    }
}
