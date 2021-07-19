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

    public function showCategoryPage($id)
    {
        $subCatController = new SubcategoryController();
        $subcategories = $subCatController->getSubcategoriesByCategoryId(
            $id
        );
        $vars['leftMenuItems'] = $subcategories;
        $productController = new ProductController();
        $category = $this->getCategoryById($id);
        $products = $productController->getProductsByCategoryId($id);
        $vars['title'] = $category[0]['name'];
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