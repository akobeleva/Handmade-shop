<?php

namespace app\models;

use core\Model;
use database\QueryBuilder;

class CategoryModel extends Model
{
    private $id;
    private $name;
    private $image_name;
    private $weight;

    protected static $table = 'category';

    public function __construct($id, $name, $image_name, $weight)
    {
        $this->id = $id;
        $this->name = $name;
        $this->image_name = $image_name;
        $this->weight = $weight;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getImageName()
    {
        return $this->image_name;
    }

    public function getWeight()
    {
        return $this->weight;
    }

    public static function getAll(): array
    {
        $queryBuilder = new QueryBuilder();
        $rows = $queryBuilder->select()->from(self::$table)->orderBy('weight')
            ->execute();
        return self::rowsToEntities($rows);
    }

    protected static function rowsToEntities($rows): array
    {
        $categories = [];
        foreach ($rows as $row) {
            $categories[$row['id']] = self::rowToEntity($row);
        }
        return $categories;
    }

    protected static function rowToEntity($row): Model
    {
        return new CategoryModel(
            $row['id'],
            $row['name'],
            $row['image_name'],
            $row['weight']
        );
    }
}