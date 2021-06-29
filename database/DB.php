<?php

namespace database;

use PDO;

class DB
{
    protected $pdo;
    protected static $instance;

    protected function __construct()
    {
        $db = require_once 'config/database.php';
        $this->pdo = new PDO($db['dsn'], $db['user'], $db['pass']);
    }

    public static function getInstance(): DB
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function execute(string $sql): bool
    {
        $statement = $this->pdo->prepare($sql);
        return $statement->execute();
    }

    public function query($sql): array
    {
        $statement = $this->pdo->prepare($sql);
        $result = $statement->execute();
        if ($result !== false) {
            return $statement->fetchAll();
        }
        return [];
    }
}