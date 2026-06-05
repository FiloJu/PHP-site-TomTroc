<?php

namespace Models;
use PDO;
use PDOStatement;
require_once '../config/database.php';
class Database {

// Singleton pattern to ensure only one connection is created - one and only one instance of PDO is used throughout the application
    private static $instance = null;

    private $db;

    private function __construct() {
        $this->db = new PDO(
            'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME,
            DB_USER,
            DB_PASS
        );
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }

    public static function getInstance(): Database
    {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public static function connect(): PDO
    {
        return self::getInstance()->db;
    }

    public function query(string $sql, array $params = []): PDOStatement
    {
        if (empty($params)) {
            return $this->db->query($sql);
        } else {
            $stmt = $this->db->prepare($sql);
            $stmt->execute($params);
            return $stmt;
        }
    }
}
