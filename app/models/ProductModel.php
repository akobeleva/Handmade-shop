<?php

namespace app\models;

use core\Model;

class ProductModel extends Model
{
    public function __construct()
    {
        parent::__construct();
        $this->table = 'product';
    }

    public function getProductsByCategoryId($categoryId): array
    {
        $sql = "SELECT id, subcategory_id, name, price, image_name FROM product 
            WHERE subcategory_id IN ( SELECT id from subcategory where category_id = "
            . $categoryId . ")";
        return $this->db->executeQuery($sql);
    }

    public function getProductsBySubcategoryId($subId): array
    {
        $sql = "SELECT * FROM $this->table WHERE subcategory_id = " . $subId;
        return $this->db->executeQuery($sql);
    }
}