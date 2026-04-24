<?php

namespace Controllers;

use Models\Entities\Book;
use Models\Managers\BookManager;
use Views\View;
use PDO;

class BookController
{
    //TODO: CREATE qui fera appel à mon manager
    public function create(array $data): void
    {
    }
    public function findAll(): void
    {
        $manager = new BookManager();
        $books = $manager->findAll();
        $view = new View();
        $view->render('books', ['books' => $books]);
    }

    public function findOne(int $id)
    {
        $manager = new BookManager();
        $book = $manager->findOne($id);
        $view = new View();
        $view->render('book', ['book' => $book]);
    }

}
