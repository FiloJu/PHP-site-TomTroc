<?php

namespace Models\Managers;

use DateTimeInterface;
use Models\Entities\User;
use ReflectionClass;

class UserManager extends AbstractEntityManager
{
    public function __construct()
    {
        parent::__construct();
        $this->table = 'users';
    }
    public function getUserByUsername(string $username): ?User
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE username = :username");
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch();
        return $user ? new User($user) : null;
    }
    public function getUserByEmail(string $email): ?User
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();
        return $user ? new User($user) : null;
    }

    public function findById(int $id): ?User
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $user = $stmt->fetch();
        return $user ? new User($user) : null;
    }

    protected function create(User $user): int
    {
        $stmt = $this->db->prepare("INSERT INTO {$this->table} (username, email, password) VALUES (:username, :email, :password)");
        $stmt->execute([
            'username' => $user->getUsername(),
            'email' => $user->getEmail(),
            'password' => password_hash($user->getPassword(), PASSWORD_BCRYPT)
        ]);
        return $this->db->lastInsertId();
    }

    public function save(User $user): int
    {
        if ($user->getId() == -1) {
            return $this->create($user);
        }
        return $this->update($user);
    }
    // public function create(array $data): int
    // {
    //     $stmt = $this->db->prepare("INSERT INTO {$this->table} (username, email, password) VALUES (:username, :email, :password)");
    //     $stmt->execute([
    //         'username' => $data['userName'],
    //         'email' => $data['email'],
    //         'password' => password_hash($data['password'], PASSWORD_BCRYPT)
    //     ]);
    //     return (int)$this->db->lastInsertId();
    // }
}
