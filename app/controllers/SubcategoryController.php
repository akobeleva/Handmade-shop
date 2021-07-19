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

    public function showSubcategoryPage($id)
    {
        $subcategory = $this->getSubcategoryById($id);
        if (!isset($subcategory)){
            $this->showNotFoundPage();
            return;
        }
        $subcategories = $this->getSubcategoriesByCategoryId($subcategory[0]['category_id']);
        if (!isset($subcategories)){
            $this->showNotFoundPage();
            return;
        }
        $vars['leftMenuItems'] = $subcategories;
        $productController = new ProductController();
        $title = $subcategory[0]['name'];
        $products = $productController->getProductsBySubcategoryId($id);
        if (!isset($products)){
            $this->showNotFoundPage();
            return;
        }
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