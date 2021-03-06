<?php

namespace app\models;

use core\Model;
use database\QueryBuilder;

class ProductModel extends Model
{
    private $id;
    private $subcategory_id;
    private $name;
    private $price;
    private $description;
    private $seller_id;
    private $image_name;

    protected static $table = 'product';
    protected static $db;

    public function __construct(
        $id,
        $subcategory_id,
        $name,
        $price,
        $description,
        $seller_id,
        $image_name
    ) {
        $this->id = $id;
        $this->subcategory_id = $subcategory_id;
        $this->name = $name;
        $this->price = $price;
        $this->description = $description;
        $this->seller_id = $seller_id;
        $this->image_name = $image_name;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getSubcategoryId()
    {
        return $this->subcategory_id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getSellerId()
    {
        return $this->seller_id;
    }

    public function getImageName()
    {
        return $this->image_name;
    }

    public static function getProductsByCategoryId($categoryId): array
    {
        $subQueryBuilder = new QueryBuilder();
        $subQuery = $subQueryBuilder->select('id')->from('subcategory')->where(
            'category_id',
            $categoryId
        );
        $queryBuilder = new QueryBuilder();
        $rows = $queryBuilder->select()->from(self::$table)->whereIn(
            'subcategory_id',
            $subQuery
        )->execute();
        return self::rowsToEntities($rows);
    }

    public static function getProductsBySubcategoryId($subId): array
    {
        $queryBuilder = new QueryBuilder();
        $rows = $queryBuilder->select()->from(self::$table)->where(
            'subcategory_id',
            $subId
        )->execute();
        return self::rowsToEntities($rows);
    }

    public static function getProductsBySellerId($sellerId): array
    {
        $queryBuilder = new QueryBuilder();
        $rows = $queryBuilder->select()->from(self::$table)->where(
            'seller_id',
            $sellerId
        )->execute();
        return self::rowsToEntities($rows);
    }

    protected static function rowsToEntities($rows): array
    {
        $entities = [];
        foreach ($rows as $row) {
            $entities[$row['id']] = self::rowToEntity($row);
        }
        return $entities;
    }

    protected static function rowToEntity($row): Model
    {
        return new ProductModel(
            $row['id'],
            $row['subcategory_id'],
            $row['name'],
            $row['price'],
            $row['description'],
            $row['seller_id'],
            $row['image_name']
        );
    }

    public static function search($searchText): array
    {
        $queryBuilder = new QueryBuilder();
        $rows = $queryBuilder->select()->from(self::$table)
            ->where('name', $searchText, 'LIKE')
            ->whereOr('description', $searchText, 'LIKE')->execute();
        return self::rowsToEntities($rows);
    }
}