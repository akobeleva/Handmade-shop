<?php

namespace app\controllers;

use app\models\ProductModel;
use app\views\PageView;
use core\Controller;
use core\Model;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->view = new PageView();
    }

    public function showProductPage($id)
    {
        $product = $this->getProductById($id);
        if (!isset($product)){
            $this->showNotFoundPage();
            return;
        }
        $vars['product']['entity'] = $product;
        $this->view->renderProductPage($vars);
    }

    public function getProductsByCategoryId($categoryId): array
    {
        return ProductModel::getProductsByCategoryId($categoryId);
    }

    public function getProductsBySubcategoryId($subcategoryId): array
    {
        return ProductModel::getProductsBySubcategoryId($subcategoryId);
    }

    public function getProductById($productId): Model
    {
        return ProductModel::getById($productId);
    }
}