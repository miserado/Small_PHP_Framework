<?php

namespace app\core;

class View
{
    private $route, $path;
    public $layout = 'default';

    public function __construct($route)
    {
        $this->route = $route;
        $this->path = $route['controller'] . '/' . $route['action'];
    }

    public function renderView(array $vars)
    {
        $path = 'app/views/' . $this->path . '.php';
        if (file_exists($path)) {
            extract($vars);
            ob_start();
            require_once($path);
            $content = ob_get_clean();
            require_once('app/views/layouts/' . $this->layout . '.php');
        } else self::showErrorPage(404);
    }

    static function redirectTo(string $url)
    {
        header('location: ' . $url);
        die();
    }

    static function showErrorPage(string $page)
    {
        http_response_code($page);
        $path = 'app/views/errors/' . $page . '.php';
        if (file_exists($path)) {
            require_once($path);
            die();
        } else die(__METHOD__);
    }
}
