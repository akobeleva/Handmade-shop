<?php

namespace app\controllers;

use core\Controller;
use core\View;

class CatalogController extends Controller
{
    public function __construct()
    {
        $this->view = new View();
    }

    public function indexAction($_get)
    {
        $categoryController = new CategoryController();
        $categories = $categoryController->getCategories();
        $vars['title'] = 'Каталог';
        $vars['catalogItems'] = $categories;
        $this->view->renderCatalogView($vars);
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
            $title = $this->model->getCategoryNameById($_get['id']);
            $products = $productController->getProductsByCategoryId(
                $_get['id']
            );
        }
        $vars['title'] = $title[0]['name'];
        $vars['catalogItems'] = $products;
        $this->view->renderRightPageView($vars);
    }

    public function productAction($_get)
    {
        $productController = new ProductController();
        $product = $productController->getProductById($_get['id']);
        $vars['product'] = $product[0];
        $this->view->renderProductPageView($vars);
    }
}