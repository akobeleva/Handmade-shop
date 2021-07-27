<?php

namespace app\controllers;

use app\models\ProductModel;
use app\views\pages\CatalogPageView;
use core\Controller;

class SearchController extends Controller
{
    public function __construct()
    {
        $this->view = new CatalogPageView();
    }

    public function showSearchAnswer($_get)
    {
        if (!isset($_get['search_text'])) {
            $this->view->renderNotFoundPage();
            return;
        }
        $searchText = $_get['search_text'];
        $products = ProductModel::search($searchText);
        if (!isset($products)) {
            $this->view->renderNotFoundPage();
            return;
        }
        $catalogItems = [];
        foreach ($products as $product) {
            $catalogItems[$product->getId()]['entity'] = $product;
        }
        $vars['catalogItems'] = $catalogItems;
        $vars['link'] = '/catalog/product';
        $vars['searchText'] = $searchText;
        $vars['additionalClass'] = 'product_card';
        $this->view->renderCatalogPage($vars);
    }
}