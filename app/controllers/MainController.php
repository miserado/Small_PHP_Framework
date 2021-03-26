<?php

namespace app\controllers;

use app\core\Controller;

class MainController extends Controller
{
    public function IndexAction()
    {
        $vars = [
            'title' => 'Main Page'
        ];
        $this->view->renderView($vars);
    }
}
