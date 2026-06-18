<?php

namespace Controllers;

use Views\View;
use Models\Managers\BookManager;

class HomeController {
    public function index() {
        $logged_in = $_SESSION['auth'] ?? false;

        $bookManager = new BookManager();
        $books = $bookManager->findLatest(6);

        $view = new View('Accueil');
        $view->render('home', ['logged_in' => $logged_in, 'books' => $books]);
    }
}
