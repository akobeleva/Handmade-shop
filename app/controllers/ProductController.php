<?php

namespace app\controllers;

use app\models\ProductModel;
use core\Controller;
use core\View;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->view = new View();
        $this->model = new ProductModel();
    }

    public function getProductsByCategoryId($categoryId): array
    {
        return $this->model->getProductsByCategoryId($categoryId);
    }

    public function getProductsBySubcategoryId($subcategoryId): array
    {
        return $this->model->getProductsBySubcategoryId($subcategoryId);
    }
}