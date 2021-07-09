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
        $data = $this->model->getAllRows();
        $vars['title'] = 'Каталог';
        $vars['catalogItems'] = $data;
        $this->view->renderCatalogView($vars);
    }

    public function categoryAction($_get)
    {
        $subCatController = new SubcategoryController();
        $subcategories = $subCatController->subcategoryAction($_get['id']);
        $title = $this->model->getCategoryNameById($_get['id']);
        $vars['title'] = $title[0]['name'];
        $vars['leftMenuItems'] = $subcategories;
        if (isset($_get['subcategory'])){
            $vars['rightContent'] = 'Подкатегория '.$_get['subcategory'];
            $this->view->renderRightPageView($vars);
        }
        else $this->view->renderLeftMenuPageView($vars);
    }
}