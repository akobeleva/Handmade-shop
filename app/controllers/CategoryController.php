<?php

namespace app\controllers;

use app\models\CategoryModel;
use core\Controller;
use core\View;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->view = new View();
        $this->model = new CategoryModel();
    }

    public function categoryAction($_get)
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
        $this->view->renderRightPageView($vars);
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