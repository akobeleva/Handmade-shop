<?php

namespace app\models;

use core\Model;

class CategoryModel extends Model
{
    public $id;
    public $name;
    public $image_name;
    public $weight;

    public function __construct()
    {
        parent::__construct();
        $this->table = 'category';
    }

    public function getCategoriesByWeight(): array
    {
        $sql = "SELECT * FROM $this->table ORDER BY weight";
        return $this->db->executeQuery($sql);
    }

    public function getCategoryNameById($categoryId): array
    {
        $sql = "SELECT name FROM $this->table WHERE id = " . $categoryId;
        return $this->db->executeQuery($sql);
    }
}