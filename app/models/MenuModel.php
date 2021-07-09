<?php

namespace app\models;

use core\Model;

class MenuModel extends Model
{
    public function __construct()
    {
        parent::__construct();
        $this->table = 'category';
    }
}