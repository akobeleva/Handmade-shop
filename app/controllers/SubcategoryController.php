<?php

namespace app\controllers;

use app\models\SubcategoryModel;
use core\Controller;
use core\View;

class SubcategoryController extends Controller
{
    public function __construct()
    {
        $this->view = new View();
        $this->model = new SubcategoryModel();
    }

    public function subcategoryAction($categoryId): array
    {
        return $this->model->getSubcategoryByCategoryId($categoryId);
    }
}