<?php

namespace App;

use App\Controller\HomeController;
use App\Controller\ProductsController;
use App\Controller\UserController;

class Router
{
    private const ROUTES = [
        '/'                      => HomeController::class . '@index',
        '/home'                  => HomeController::class . '@index',
        '/contact'               => HomeController::class . '@contact',
        '/register'              => UserController::class . '@register',
        '/login'                 => UserController::class . '@login',
        '/logout'                => UserController::class . '@logout',
        '/products'              => ProductsController::class . '@products',
        '/account'               => UserController::class . '@account',
        '/productDescription/:id'    => ProductsController::class . '@productsDescription',
    ];

    public static function handleRequest()
    {
        $uri = $_SERVER['REQUEST_URI'];
        if (isset(self::ROUTES[$uri])) {
            $route = self::ROUTES[$uri];
            list($controller, $method) = explode('@', $route);
            self::executeControllerMethod($controller, $method);
        }
        if (preg_match('/\/productDescription\/(\d+)/', $uri, $matches)) {
            $id = $matches[1];
            $route = str_replace(':id', $id, self::ROUTES['/productDescription/:id']);
            list($controller, $method) = explode('@', $route);
            self::executeControllerMethod($controller, $method, $id);
        } else {
            self::renderErrorPage(404);
        }
    }

    private static function executeControllerMethod($controller, $method, $id = null)
    {
        $controllerInstance = new $controller();
        if (method_exists($controllerInstance, $method)) {
            $controllerInstance->$method($id);
        } else {
            self::renderErrorPage(404);
        }
    }

    private static function renderErrorPage($errorCode)
    {
        http_response_code($errorCode);
    }
}
