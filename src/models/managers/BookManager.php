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
    public function findAllAvailable(): array
    {
        $stmt = $this->db->query("SELECT * FROM {$this->table} WHERE is_available = 1");
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
    public function findByUserId(int $userId): array
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE user_id = :user_id");
        $stmt->execute(['user_id' => $userId]);
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

    public function findAllAndSortByTitle(): array
    {
        $stmt = $this->db->query("SELECT * FROM {$this->table} ORDER BY title ASC");
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

    public function create(array $data): int
    {
        $stmt = $this->db->prepare(
            "INSERT INTO {$this->table} (user_id, title, author, image, description, is_available) VALUES (:user_id, :title, :author, :image, :description, :is_available)"
        );

        $stmt->execute([
            'user_id' => $data['user_id'],
            'title' => $data['title'],
            'author' => $data['author'],
            'image' => $data['image'],
            'description' => $data['description'],
            'is_available' => $data['is_available'],
        ]);

        return (int) $this->db->lastInsertId();
    }

    public function update(int $id, array $data): void
    {
        $stmt = $this->db->prepare(
            "UPDATE {$this->table} SET title = :title, author = :author, image = :image, description = :description, is_available = :is_available WHERE id = :id"
        );

        $stmt->execute([
            'id' => $id,
            'title' => $data['title'],
            'author' => $data['author'],
            'image' => $data['image'],
            'description' => $data['description'],
            'is_available' => $data['is_available'],
        ]);
    }
    public function delete(int $id): void
    {
        $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE id = :id");
        $stmt->execute(['id' => $id]);
    }
}

