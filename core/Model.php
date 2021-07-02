<?php

namespace core;

use database\DB;

abstract class Model
{
    protected $db;
    protected $table;

    public function __construct(string $tableName = null)
    {
        $this->db = DB::getInstance();
        $this->table = $tableName;
    }

    public function getAllRows(): array
    {
        $sql = "SELECT * FROM $this->table";
        return $this->db->executeQuery($sql);
    }
}