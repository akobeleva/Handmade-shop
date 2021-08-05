<?php

namespace app\views\pages;

use app\views\CatalogTableView;

class UserAccountPageView extends SidebarPageView
{
    public function renderUserProfilePage($vars = [])
    {
        $this->renderPageContent($vars);
    }

    public function renderUserOrdersPage($vars = [])
    {
        $this->renderPageContent($vars);
    }

    public function renderUserProductsPage($vars =[]){
        $catalogView = new CatalogTableView();
        $vars['link'] = '/catalog/product';
        $vars['columnWidth'] = 4;
        $vars['additionalClass'] = 'product_card';
        $rightContent = $catalogView->renderCatalogTableView($vars);
        $vars['rightContent'] = $rightContent;
        $this->renderPageContent($vars);
    }
    public function renderUserFavoritesPage($vars = [])
    {
        $this->renderPageContent($vars);
    }
}