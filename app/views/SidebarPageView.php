<?php

namespace app\views;

class SidebarPageView extends PageView
{
    public function renderCategoryPage($vars = [])
    {
        $catalogView = new CatalogView();
        $vars['link'] = '/catalog/product';
        $vars['columnWidth'] = 4;
        $vars['additionalClass'] = 'product_card';
        $rightContent = $catalogView->renderCatalogView($vars);
        $vars['rightContent'] = $rightContent;
        foreach ($vars['leftMenuItems'] as &$item) {
            $item['link'] = "/catalog/category/?id=" . $item['category_id']
                . "&subcategory=" . $item['id'];
        }
        $text = $this->renderTemplate('sidebar_tpl.php', $vars);
        $vars['text'] = $text;
        $this->renderPageContent($vars);
    }
}