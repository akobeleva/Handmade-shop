<?php

namespace app\controllers;

use app\models\CategoryModel;
use core\Controller;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->model = new CategoryModel();
    }

    public function getCategories(): array
    {
        return $this->model->getCategoriesByWeight();
    }

    public function getCategoryById($id): array
    {
        return $this->model->getRowById($id);
    }
}