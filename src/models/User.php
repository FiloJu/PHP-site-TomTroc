<?php

namespace Models;

use DateTime;
class User {
    private int $id;
    private string $username;
    private string $email;
    private string $password;
    private ?string $avatar;
    private DateTime $created_at;

    public function __construct(int $id, string $username, string $email, string $password, ?string $avatar, DateTime $created_at) {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->avatar = $avatar;
        $this->created_at = $created_at;
    }
    public function getId() : int {
        return $this->id;
    }
    public function getUsername() : string {
        return $this->username;
    }
    public function getEmail() : string {
        return $this->email;
    }
    public function getPassword() : string {
        return $this->password;
    }
    public function getAvatar() : ?string {
        return $this->avatar;
    }
    public function getCreatedAt() : DateTime {
        return $this->created_at;
    }
}
