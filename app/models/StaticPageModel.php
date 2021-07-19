<?php

namespace app\models;

use core\Model;

class StaticPageModel extends Model
{
    public function __construct()
    {
        parent::__construct();
        $this->table = 'static_pages';
    }

    public function getTextByTitle($title): array
    {
        $sql = "SELECT text FROM $this->table WHERE title = '" . $title . "'";
        return $this->db->executeQuery($sql);
    }
}