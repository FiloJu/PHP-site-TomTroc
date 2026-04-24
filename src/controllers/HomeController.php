<?php

namespace Controllers;

use Views\View;

class HomeController {
    public function index() {
        $logged_in = $_SESSION['auth'] ?? false;
        $view = new View();
        $view->render('home', ['logged_in' => $logged_in]);
    }
}
