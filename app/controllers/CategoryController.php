<?php

namespace app\controllers;

use app\models\CategoryModel;
use app\views\SidebarPageView;
use core\Controller;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->view = new SidebarPageView();
        $this->model = new CategoryModel();
    }

    public function showCategoryPage($_get)
    {
        $subCatController = new SubcategoryController();
        $subcategories = $subCatController->getSubcategoriesByCategoryId(
            $_get['id']
        );
        $vars['leftMenuItems'] = $subcategories;
        $productController = new ProductController();
        $title = $this->getCategoryById($_get['id']);
        $products = $productController->getProductsByCategoryId($_get['id']);
        $vars['title'] = $title[0]['name'];
        $vars['catalogItems'] = $products;
        $this->view->renderCategoryPage($vars);
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