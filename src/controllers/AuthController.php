<?php

namespace Controllers;

class AuthController
{
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $_SESSION['auth'] = true;
            return header('location: index.php');
        }

        require_once '../src/views/login.php';
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // TODO: Inscription à implémenter
            $_SESSION['auth'] = true;
            return header('location: index.php');
        }

        require_once '../src/views/register.php';
    }
}