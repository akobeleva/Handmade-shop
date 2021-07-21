<?php

namespace app\controllers;

use app\models\SubcategoryModel;
use app\views\SidebarPageView;
use core\Controller;
use core\Model;

class SubcategoryController extends Controller
{
    public function __construct()
    {
        $this->view = new SidebarPageView();
    }

    public function showSubcategoryPage($id)
    {
        $subcategory = $this->getSubcategoryById($id);
        if (!isset($subcategory)) {
            $this->showNotFoundPage();
            return;
        }
        $vars['title'] = $subcategory->getName();
        $subcategories = $this->getRelatedSubcategories($subcategory);
        if (!isset($subcategories)) {
            $this->showNotFoundPage();
            return;
        }
        $leftMenuItems = [];
        foreach ($subcategories as $subcategory) {
            $leftMenuItems[$subcategory->getId()]['entity'] = $subcategory;
        }
        $vars['leftMenuItems'] = $leftMenuItems;
        $productController = new ProductController();
        $products = $productController->getProductsBySubcategoryId($id);
        if (!isset($products)) {
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

    public function getSubcategoriesByCategoryId($categoryId): array
    {
        return SubcategoryModel::getSubcategoryByCategoryId($categoryId);
    }

    public function getSubcategoryById($subcategoryId): Model
    {
        return SubcategoryModel::getById($subcategoryId);
    }

    public function getRelatedSubcategories($subcategory): array
    {
        return $this->getSubcategoriesByCategoryId($subcategory->getCategoryId());
    }
}