<?php

namespace app\controllers;

use app\models\CategoryModel;
use app\views\SidebarPageView;
use core\Controller;
use core\Model;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->view = new SidebarPageView();
    }

    public function showCategoryPage($id)
    {
        $subCatController = new SubcategoryController();
        $subcategories = $subCatController->getSubcategoriesByCategoryId($id);
        if (!isset($subcategories)){
            $this->showNotFoundPage();
            return;
        }
        $leftMenuItems = [];
        foreach ($subcategories as $subcategory) {
            $leftMenuItems[$subcategory->getId()]['entity'] = $subcategory;
        }
        $vars['leftMenuItems'] = $leftMenuItems;
        $category = $this->getCategoryById($id);
        if (!isset($category)){
            $this->showNotFoundPage();
            return;
        }
        $vars['title'] = $category->getName();
        $productController = new ProductController();
        $products = $productController->getProductsByCategoryId($id);
        if (!isset($products)){
            $this->showNotFoundPage();
            return;
        }
        $catalogItems = [];
        foreach ($products as $product) {
            $catalogItems[$product->getId()]['entity'] = $product;
        }
        $vars['catalogItems'] = $catalogItems;
        $this->view->renderCategoryPage($vars);
    }

    public function getCategories(): array
    {
        return CategoryModel::getAll();
    }

    public function getCategoryById($id): Model
    {
        return CategoryModel::getById($id);
    }
}