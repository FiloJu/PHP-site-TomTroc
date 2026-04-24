<?php

namespace Controllers;

use Views\View;

class AuthController
{
    public function login()
    {
        $view = new View();
        $view->render('login');
    }

    public function register()
    {
        $view = new View();
        $view->render('register');
    }
}