<?php

namespace app\controllers;

use app\models\SubcategoryModel;
use app\views\SidebarPageView;
use core\Controller;

class SubcategoryController extends Controller
{
    public function __construct()
    {
        $this->view = new SidebarPageView();
        $this->model = new SubcategoryModel();
    }

    public function showSubcategoryPage($_get)
    {
        $subcategory = $this->getSubcategoryById($_get['id']);
        $subcategories = $this->getSubcategoriesByCategoryId($subcategory[0]['category_id']);
        $vars['leftMenuItems'] = $subcategories;
        $productController = new ProductController();
        $title = $subcategory[0]['name'];
        $products = $productController->getProductsBySubcategoryId($_get['id']);
        $vars['title'] = $title;
        $vars['catalogItems'] = $products;
        $this->view->renderCategoryPage($vars);
    }

    public function getSubcategoriesByCategoryId($categoryId): array
    {
        return $this->model->getSubcategoryByCategoryId($categoryId);
    }

    public function getSubcategoryById($subcategoryId): array
    {
        return $this->model->getRowById($subcategoryId);
    }
}