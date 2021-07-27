<?php

namespace app\controllers;

use app\models\SearchModel;
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
        $query = $_get['query'];
        $products = SearchModel::search($query);
        $catalogItems = [];
        foreach ($products as $product) {
            $catalogItems[$product->getId()]['entity'] = $product;
        }
        $vars['catalogItems'] = $catalogItems;
        $vars['link'] = 'catalog/product';
        $vars['query'] = $query;
        $this->view->renderCatalogPage($vars);
    }
}