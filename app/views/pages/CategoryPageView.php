<?php

namespace app\views\pages;

use app\views\CatalogTableView;

class CategoryPageView extends SidebarPageView
{
    public function renderCategoryPage($vars = [])
    {
        $catalogView = new CatalogTableView();
        $vars['link'] = '/catalog/product';
        $vars['columnWidth'] = 4;
        $vars['additionalClass'] = 'product_card';
        $rightContent = $catalogView->renderCatalogTableView($vars);
        $vars['rightContent'] = $rightContent;
        foreach ($vars['leftMenuItems'] as &$item) {
            $item['link'] = "/catalog/subcategory/" . $item['entity']->getId();
        }
        $this->renderPageContent($vars);
    }
}