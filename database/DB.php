<?php

namespace database;

use PDO;

class DB
{
    private $pdo;
    private static $instance;

    private function __construct()
    {
        $db = require_once '../config/database.php';
        $options = [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];
        $this->pdo = new PDO($db['dsn'], $db['user'], $db['pass'], $options);
    }

    public static function getInstance(): DB
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function executeUpdate(string $sql): bool
    {
        $statement = $this->pdo->prepare($sql);
        return $statement->execute();
    }

    public function executeQuery($sql): array
    {
        $statement = $this->pdo->prepare($sql);
        $result = $statement->execute();
        if ($result !== false) {
            return $statement->fetchAll();
        }
        return [];
    }
}