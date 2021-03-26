<?php

namespace app\controllers;

use app\core\Controller;

class AccountController extends Controller
{
    public function RegisterAction()
    {
        $vars = [
            'title' => 'Register Page'
        ];
        $this->view->renderView($vars);
    }

    public function LoginAction()
    {
        $vars = [
            'title' => 'Login Page'
        ];
        $this->view->renderView($vars);
    }
}
