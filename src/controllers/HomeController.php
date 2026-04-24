<?php

namespace Controllers;
class HomeController {
    public function index() {
        $logged_in = $_SESSION['auth'] ?? false;
        require_once '../src/views/home.php';
    }
}
