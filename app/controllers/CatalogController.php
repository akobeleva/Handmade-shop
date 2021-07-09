<?php

namespace app\controllers;

use app\models\CatalogModel;
use core\Controller;
use core\View;

class CatalogController extends Controller
{
    public function __construct()
    {
        $this->view = new View();
        $this->model = new CatalogModel();
    }

    public function indexAction()
    {
        if (!$_GET){
            $data = $this->model->getAllRows();
            $this->view->renderPage('CatalogView.php', $data);
        }
        else $this->categoryAction($_GET['category']);
    }

    private function categoryAction($categoryId){
        $subCatController = new SubcategoryController();
        $subcategories = $subCatController->subcategoryAction($categoryId);
        $leftMenu = $this->view->renderTemplate('left_menu_tpl.php', ['menuItems'=>$subcategories]);
        $content = $this->view->renderTemplate(
            'simple_page_tpl.php',
            [
                'title' => 'Каталог',
                'leftMenu'  => $leftMenu
            ]
        );
        echo $this->view->renderTemplate(
            'main_tpl.php',
            ['content' => $content]
        );
    }
}