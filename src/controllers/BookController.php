<?php

namespace Controllers;

use Models\Managers\BookManager;
use Views\View;
use Exception;

class BookController
{
    public function findAll(): void
    {
        $manager = new BookManager();
        $books = $manager->findAll();
        $view = new View("Liste des livres");
        $view->render('books', ['books' => $books]);
    }

    public function findOne(int $id)
    {
        $manager = new BookManager();
        $book = $manager->findOne($id);

        if (!$book) {
            throw new Exception("Book not found", 404);
        }

        $view = new View($book->getTitle());
        $view->render('book', ['book' => $book]);
    }

    public function create(array $data = []): void
    {
        // Récupérer les données POST si c'est une requête POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $_POST;
        }

        // Traiter la création du livre si on a des données POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($data)) {
            if (empty($data['title']) || empty($data['author'])) {
                throw new Exception("Title and author are required", 400);
            }

            // Add current user_id to data
            $data['user_id'] = $_SESSION['user_id'] ?? 1; // Default to 1 if not logged in
            $data['is_available'] = 1; // New books are available by default
            $data['image'] = empty(trim($data['image'] ?? '')) ? null : trim($data['image']);
            $data['description'] = empty(trim($data['description'] ?? '')) ? null : trim($data['description']);

            $manager = new BookManager();
            $bookId = $manager->create($data);

            // Redirect to the newly created book
            header("Location: index.php?action=book&id={$bookId}");
            exit;
        }

        $view = new View("Créer un livre");
        $view->render('createBook');
    }

    public function delete(int $id): void
    {
        $manager = new BookManager();
        $manager->delete($id);

        // Redirect to the book list after deletion
        header("Location: index.php?action=books");
        exit;
    }
}
