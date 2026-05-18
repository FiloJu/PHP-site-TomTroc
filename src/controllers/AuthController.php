<?php

namespace Controllers;

use Views\View;

class AuthController
{
    public function login()
    {
        $view = new View('Connexion');
        $view->render('login');
    }

    public function register()
    {
        $view = new View('Inscription');
        $view->render('register');
    }
}