<?php

namespace app\controllers;

use app\models\SubcategoryModel;
use core\Controller;

class SubcategoryController extends Controller
{
    public function __construct()
    {
        $this->model = new SubcategoryModel();
    }

    public function getSubcategoriesByCategoryId($categoryId): array
    {
        return $this->model->getSubcategoryByCategoryId($categoryId);
    }

    public function getSubcategoryById($subcategoryId): array
    {
        return $this->model->getRowById($subcategoryId);
    }
}