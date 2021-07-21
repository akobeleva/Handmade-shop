<?php

namespace app\controllers;

use app\models\ProductModel;
use app\views\pages\ProductPageView;
use core\Controller;
use core\Model;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->view = new ProductPageView();
    }

    public function showProductPage($id)
    {
        $product = $this->getProductById($id);
        if (!isset($product)){
            $this->showNotFoundPage();
            return;
        }
        $vars['product']['entity'] = $product;
        $this->view->renderPageContent($vars);
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