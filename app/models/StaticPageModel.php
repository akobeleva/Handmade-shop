<?php

namespace app\models;

use core\Model;

class StaticPageModel extends Model
{
    public $id;
    public $title;
    public $text;

    public function __construct()
    {
        parent::__construct();
        $this->table = 'static_pages';
    }

    public function getStaticPageById($id): array
    {
        $sql = "SELECT * FROM $this->table WHERE id = " . $id;
        return $this->db->executeQuery($sql);
    }
}