<?php

namespace Models\Entities;

use DateTime;
class User extends AbstractEntity
{
    private string $username;
    private string $email;
    private string $password;
    private ?string $avatar;
    private DateTime $created_at;
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }
    public function setAvatar(?string $avatar): void
    {
        $this->avatar = $avatar;
    }
    public function setCreatedAt($created_at): void
    {
        if (is_string($created_at)) {
            $this->created_at = new DateTime($created_at);
            return;
        }
        if ($created_at instanceof DateTime) {
            $this->created_at = $created_at;
            return;
        }
        // Fallback to now if unexpected type
        $this->created_at = new DateTime();
    }
    public function getUsername(): string
    {
        return $this->username;
    }
    public function getEmail(): string
    {
        return $this->email;
    }
    public function getPassword(): string
    {
        return $this->password;
    }
    public function getAvatar(): ?string
    {
        return $this->avatar;
    }
    public function getCreatedAt(): DateTime
    {
        return $this->created_at;
    }
}
