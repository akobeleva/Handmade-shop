<?php

namespace app\views;

use core\View;

class  CatalogView extends View
{
    public function renderCatalogView($vars = [])
    {
        foreach ($vars['catalogItems'] as &$item) {
            $cardView = new CardView();
            $item['link'] = $vars['link'];
            if (isset($vars['additionalClass'])){
                $item['additionalClass'] = $vars['additionalClass'];
            }
            $item['cardBody'] = $cardView->renderBody($item);
            $item['card'] = $cardView->renderCard($item);
        }
        return $this->renderTemplate('catalog_tpl.php', $vars);
    }
}