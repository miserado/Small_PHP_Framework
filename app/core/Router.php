<?php

namespace app\core;

use app\core\Config;

class Router
{
    private array $routes;
    private array $params;

    public function __construct()
    {
        $array = Config::getConfig('routes');
        foreach ($array as $key => $value)
            $this->addRoute($key, $value);
    }

    private function addRoute($route, $params)
    {
        $route = '#^' . $route . '$#';
        $this->routes[$route] = $params;
    }

    private function routeMatch(): bool
    {
        $url = trim($_SERVER['REQUEST_URI'], '/');
        foreach ($this->routes as $route => $params)
            if (preg_match($route, $url)) {
                $this->params = $params;
                return true;
            }
        return false;
    }

    public function routeLaunch()
    {
        $error = true;
        if ($this->routeMatch()) {
            $class = 'app\controllers\\' . ucfirst($this->params['controller']) . 'Controller';
            if (class_exists($class)) {
                $action = $this->params['action'] . 'Action';
                if (method_exists($class, $action)) {
                    $error = false;
                    $controller = new $class($this->params);
                    $controller->$action();
                }
            }
        }
        if ($error) die(__METHOD__);
    }
}
