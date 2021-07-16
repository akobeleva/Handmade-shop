<?php

namespace app\views;

use core\View;

class RightCategoryView extends View
{
    public function render($vars = [])
    {
        foreach ($vars['catalogItems'] as &$item){
            $cardView = new CardView();
            $item['link'] = '/catalog/product';
            $item['additionalClass'] = 'product_card';
            $item['cardBody'] = $cardView->renderBody($item);
            $item['card'] = $cardView->renderCard($item);
        }
        $vars['columnWidth'] = 4;
        $rightContent = $this->renderTemplate('catalog_tpl.php', $vars);
        $vars['rightContent'] = $rightContent;
        $leftMenuView = new LeftMenuView();
        $leftMenuView->render($vars);
    }
}