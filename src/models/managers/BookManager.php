<?php

namespace Models\Managers;
use PDO;
use Models\Entities\Book;
use Models\Database;

// TODO: Requetes SQL pour CRUD ici 
class BookManager
{
    private PDO $db;
    private string $table = "books";

    public function __construct()
    {
        $this->db = Database::connect();
    }

    public function findAll(): array
    {
        $stmt = $this->db->query("SELECT * FROM {$this->table}");
        $booksData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $books = [];
        foreach ($booksData as $bookData) {
            $books[] = new Book(
                $bookData['id'],
                $bookData['user_id'],
                $bookData['title'],
                $bookData['author'],
                $bookData['image'],
                $bookData['description'],
                $bookData['is_available']
            );
        }
        return $books;
    }

    public function findOne(int $id): ?Book
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $bookData = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($bookData) {
            return new Book(
                $bookData['id'],
                $bookData['user_id'],
                $bookData['title'],
                $bookData['author'],
                $bookData['image'],
                $bookData['description'],
                $bookData['is_available']
            );
        }
        return null;
    }
}

