<?php

namespace app\controllers;

use app\models\CategoryModel;
use app\views\RightContentView;
use core\Controller;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->view = new RightContentView();
        $this->model = new CategoryModel();
    }

    public function show($_get)
    {
        $subCatController = new SubcategoryController();
        $subcategories = $subCatController->getSubcategoriesByCategoryId(
            $_get['id']
        );
        $vars['leftMenuItems'] = $subcategories;
        $productController = new ProductController();
        if (isset($_get['subcategory'])) {
            $title = $subCatController->getSubcategoryById(
                $_get['subcategory']
            );
            $products = $productController->getProductsBySubcategoryId(
                $_get['subcategory']
            );
        } else {
            $title = $this->getCategoryById($_get['id']);
            $products = $productController->getProductsByCategoryId(
                $_get['id']
            );
        }
        $vars['title'] = $title[0]['name'];
        $vars['catalogItems'] = $products;
        $this->view->render($vars);
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