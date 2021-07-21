<?php

namespace app\models;

use core\Model;

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
        self::checkDB();
        $sql = "SELECT * FROM " . self::$table
            . " WHERE subcategory_id IN ( SELECT id from subcategory where category_id = "
            . $categoryId . ")";
        $rows = static::$db->executeQuery($sql);
        return self::rowsToEntities($rows);
    }

    public static function getProductsBySubcategoryId($subId): array
    {
        self::checkDB();
        $sql = "SELECT * FROM " . self::$table . " WHERE subcategory_id = "
            . $subId;
        $rows = static::$db->executeQuery($sql);
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


}