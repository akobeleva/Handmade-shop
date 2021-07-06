<?php

namespace app\models;

use core\Model;

class CatalogModel extends Model
{
    public function __construct()
    {
        parent::__construct();
        $this->table = 'category';
    }
}