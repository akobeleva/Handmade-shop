<?php

namespace core;

use database\DB;

abstract class Model
{
    protected $db;
    protected $table;

    public function __construct()
    {
        $this->db = DB::getInstance();
    }

    public function getAllRows(): array
    {
        $sql = "SELECT * FROM $this->table";
        return $this->db->executeQuery($sql);
    }

    public function getRowById($id): array
    {
        $sql = "SELECT * FROM $this->table WHERE id = " . $id;
        return $this->db->executeQuery($sql);
    }
}