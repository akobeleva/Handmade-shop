<?php

namespace core;

use database\DB;

abstract class Model
{
    protected static $db;
    protected static $table;

    public static function getAll(): array
    {
        self::checkDB();
        $sql = "SELECT * FROM " . static::$table;
        $rows = static::$db->executeQuery($sql);
        return static::rowsToEntities($rows);
    }

    public static function getById($id): Model
    {
        self::checkDB();
        $sql = "SELECT * FROM " . static::$table . " WHERE id = " . $id;
        $rows = static::$db->executeQuery($sql);
        return static::rowToEntity($rows[0]);
    }

    protected static function checkDB()
    {
        if (static::$db === null) {
            static::$db = DB::getInstance();
        }
    }

    protected static function rowsToEntities($rows): array
    {
    }

    protected static function rowToEntity($row): Model
    {
    }
}