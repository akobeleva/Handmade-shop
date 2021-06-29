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

    public function query($sql): bool
    {
        return $this->db->execute($sql);
    }

    public function findAll(): array
    {
        $sql = "SELECT * FROM {$this->table}";
        return $this->db->query($sql);
    }
}