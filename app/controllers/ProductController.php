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

    public function productAction($_get)
    {
        $productController = new ProductController();
        $product = $productController->getProductById($_get['id']);
        $vars['product'] = $product[0];
        $this->view->renderProductPageView($vars);
    }

    public function getProductsByCategoryId($categoryId): array
    {
        return $this->model->getProductsByCategoryId($categoryId);
    }

    public function getProductsBySubcategoryId($subcategoryId): array
    {
        return $this->model->getProductsBySubcategoryId($subcategoryId);
    }

    public function getProductById($productId): array
    {
        return $this->model->getRowById($productId);
    }
}