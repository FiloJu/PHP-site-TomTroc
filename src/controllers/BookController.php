<?php

namespace Controllers;

use Models\Entities\Book;
use PDO;

class BookController
{
    //TODO: CREATE qui fera appel à mon manager
    public function create(array $data): void
    {
    }
    public function findAll(): void
    {
        $manager = new \Models\Managers\BookManager();
        $books = $manager->findAll();
        require '../src/views/books.php'; 
    }

    public function findOne(int $id)
    {
        $manager = new \Models\Managers\BookManager();
        $book = $manager->findOne($id);
        require '../src/views/book.php';
    }

}
