<?php

namespace Models;
class Book {
    private int $id;
    private int $user_id;
    private string $title;
    private string $author;
    private ?string $image;
    private ?string $description;
    private bool $is_available;

    public function __construct(int $id, int $user_id, string $title, string $author, ?string $image, ?string $description, bool $is_available) {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->title = $title;
        $this->author = $author;
        $this->image = $image;
        $this->description = $description;
        $this->is_available = $is_available;
    }
    public function getId() : int {
        return $this->id;
    }
    public function getUserId() : int {
        return $this->user_id;
    }
    public function getTitle() : string {
        return $this->title;
    }
    public function getAuthor() : string {
        return $this->author;
    }
    public function getImage() : ?string {
        return $this->image;
    }
    public function getDescription() : ?string {
        return $this->description;
    }
    public function isAvailable() : bool {
        return $this->is_available;
    }
}

