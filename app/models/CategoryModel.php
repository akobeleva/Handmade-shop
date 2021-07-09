<?php

namespace app\models;

use core\Model;

class CategoryModel extends Model
{
    public function __construct()
    {
        parent::__construct();
        $this->table = 'category';
    }

    public function getCategoryNameById($categoryId): array
    {
        $sql = "SELECT name FROM $this->table WHERE id = " . $categoryId;
        return $this->db->executeQuery($sql);
    }
}