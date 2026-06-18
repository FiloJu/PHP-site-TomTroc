<?php

namespace Models\Managers;
use Models\Entities\User;

class UserManager extends AbstractEntityManager
{
    private string $table = "users";

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

    public function create(array $data): int
    {
        $stmt = $this->db->prepare("INSERT INTO {$this->table} (username, email, password) VALUES (:username, :email, :password)");
        $stmt->execute([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => password_hash($data['password'], PASSWORD_BCRYPT)
        ]);
        return (int)$this->db->lastInsertId();
    }

    public function update(int $id, array $data): void
    {
        $fields = [];
        $params = ['id' => $id];

        if (isset($data['username'])) {
            $fields[] = 'username = :username';
            $params['username'] = $data['username'];
        }
        if (isset($data['email'])) {
            $fields[] = 'email = :email';
            $params['email'] = $data['email'];
        }
        if (isset($data['password'])) {
            $fields[] = 'password = :password';
            $params['password'] = $data['password'];
        }
        if (isset($data['avatar'])) {
            $fields[] = 'avatar = :avatar';
            $params['avatar'] = $data['avatar'];
        }

        if (empty($fields)) {
            return;
        }

        $sql = "UPDATE {$this->table} SET " . implode(', ', $fields) . " WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
    }

}