<?php

use app\core\Config;
use app\core\Router;

spl_autoload_register(function (string $ClassName) {
    $path = str_replace('\\', '/', $ClassName) . '.php';
    if (file_exists($path))
        require_once($path);
});

$CONFIG = new Config();
$ROUTER = new Router();
$ROUTER->routeLaunch();
