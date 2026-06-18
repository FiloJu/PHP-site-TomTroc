<?php

namespace Models\Managers;
use PDO;
use Models\Entities\Book;

// TODO: Requetes SQL pour CRUD ici 
class BookManager extends AbstractEntityManager
{
    private string $table = "books";

    public function findAll(): array
    {
        $stmt = $this->db->query("SELECT * FROM {$this->table}");
        $booksData = $stmt->fetchAll();
        $books = [];
        foreach ($booksData as $bookData) {
            $books[] = new Book($bookData);
        }
        return $books;
    }
    //TODO : pas besoin si on affiche tous les livres avec le badge non dispo ?
    public function findAllAvailable(): array
    {
        $stmt = $this->db->query("SELECT * FROM {$this->table} WHERE is_available = 1");
        $booksData = $stmt->fetchAll();
        $books = [];
        foreach ($booksData as $bookData) {
            $books[] = new Book($bookData);
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
            $books[] = new Book($bookData);
        }
        return $books;
    }

    public function findAllAndSortByTitle(): array
    {
        $stmt = $this->db->query("SELECT * FROM {$this->table} ORDER BY title ASC");
        $booksData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $books = [];
        foreach ($booksData as $bookData) {
            $books[] = new Book($bookData);
        }
        return $books;
    }
    public function findOne(int $id): ?Book
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $bookData = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($bookData) {
            return new Book($bookData);
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

    public function findLatest(int $limit = 6): array
    {
        $limit = (int) $limit;
        $stmt = $this->db->query("SELECT * FROM {$this->table} ORDER BY id DESC LIMIT {$limit}");
        $booksData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $books = [];
        foreach ($booksData as $bookData) {
            $books[] = new Book($bookData);
        }
        return $books;
    }
}

