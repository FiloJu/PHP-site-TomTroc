<?php

namespace Models;
use PDO;
require_once '../config/database.php';
class Database {
    private static $instance = null;

// Singleton pattern to ensure only one connection is created - one and only one instance of PDO is used throughout the application
// TODO :Voir pourquoi on ne passe pas dedans
    public static function connect() {
        if (self::$instance === null) {
            self::$instance = new PDO(
                'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME,
                DB_USER,
                DB_PASS
            );
            self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$instance;
    }
}
