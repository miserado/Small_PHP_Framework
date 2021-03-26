<?php

namespace app\core;

use app\core\View;

abstract class Controller
{
    protected $route, $view;


    public function __construct($route)
    {
        $this->route = $route;
        $this->view = new View($route);
    }
}
