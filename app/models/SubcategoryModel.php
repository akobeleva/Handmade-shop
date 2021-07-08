<?php

namespace app\models;

use core\Model;

class SubcategoryModel extends Model
{
    public function __construct()
    {
        parent::__construct();
        $this->table = 'subcategory';
    }

    public function getSubcategoryByCategoryId($categoryId): array
    {
        $sql = "SELECT * FROM $this->table WHERE category_id = " . $categoryId;
        return $this->db->executeQuery($sql);
    }
}