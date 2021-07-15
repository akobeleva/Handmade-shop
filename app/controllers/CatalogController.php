<?php

namespace app\controllers;

use app\models\CategoryModel;
use core\Controller;
use core\View;

class CatalogController extends Controller
{
    public function __construct()
    {
        $this->view = new View();
        $this->model = new CategoryModel();
    }

    public function indexAction($_get)
    {
        $data = $this->model->getCategoriesByWeight();
        $vars['title'] = 'Каталог';
        $vars['catalogItems'] = $data;
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