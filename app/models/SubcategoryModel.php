<?php

namespace app\models;

use core\Model;
use database\QueryBuilder;

class SubcategoryModel extends Model
{
    private $id;
    private $category_id;
    private $name;

    protected static $table = 'subcategory';

    public function __construct($id, $category_id, $name)
    {
        $this->id = $id;
        $this->category_id = $category_id;
        $this->name = $name;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getCategoryId()
    {
        return $this->category_id;
    }

    public function getName()
    {
        return $this->name;
    }

    public static function getSubcategoryByCategoryId($categoryId): array
    {
        $queryBuilder = new QueryBuilder();
        $rows = $queryBuilder->select()->from(self::$table)->where(
            'category_id',
            $categoryId
        )->execute();
        return self::rowsToEntities($rows);
    }

    protected static function rowsToEntities($rows): array
    {
        $subcategories = [];
        foreach ($rows as $row) {
            $subcategories[$row['id']] = self::rowToEntity($row);
        }
        return $subcategories;
    }

    protected static function rowToEntity($row): Model
    {
        return new SubcategoryModel(
            $row['id'],
            $row['category_id'],
            $row['name']
        );
    }
}