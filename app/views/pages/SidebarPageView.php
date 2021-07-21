<?php

namespace app\views\pages;

use app\views\CatalogTableView;

class SidebarPageView extends PageView
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
        $text = $this->renderTemplate('sidebar_tpl.php', $vars);
        $vars['text'] = $text;
        $this->renderPageContent($vars);
    }
}