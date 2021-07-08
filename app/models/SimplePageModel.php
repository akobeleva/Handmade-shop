<?php

namespace app\models;

use core\Model;

class SimplePageModel extends Model
{
    public function __construct()
    {
        parent::__construct();
        $this->table = 'simple_content_pages';
    }

    public function getTextByTitle($title): array
    {
        $sql = "SELECT text FROM $this->table WHERE title = '" . $title . "'";
        return $this->db->executeQuery($sql);
    }
}