<?php

namespace core;

define('VIEW_ROOT', '../app/views/');

class View
{
    public function renderTemplate(string $templateName, $vars = [])
    {
        if (is_array($vars)) {
            extract($vars);
        }
        ob_start();
        if (file_exists(VIEW_ROOT . 'templates/' . $templateName)) {
            require_once VIEW_ROOT . 'templates/' . $templateName;
        } else {
            require_once VIEW_ROOT . $templateName;
        }
        $content = ob_get_clean();
        return $content;
    }

    public function renderLeftMenuPageView($vars = [])
    {
        $leftMenu = $this->renderTemplate('left_menu_tpl.php', $vars);
        $vars['text'] = $leftMenu;
        $this->renderSimplePageView($vars);
    }

    public function renderCatalogView($vars = [])
    {
        $catalog = $this->renderTemplate('catalog_tpl.php', $vars);
        $vars['text'] = $catalog;
        $vars['title'] = 'Каталог';
        $this->renderSimplePageView($vars);
    }

    public function renderSimplePageView($vars = [])
    {
        $content = $this->renderTemplate('simple_page_tpl.php', $vars);
        $vars['content'] = $content;
        $this->renderMainView($vars);
    }

    public function renderMainView($vars = [])
    {
        echo $this->renderTemplate('main_tpl.php', $vars);
    }

    public function renderRightPageView($vars = [])
    {
        $rightContent = $this->renderTemplate('catalog_tpl.php', $vars);
        $vars['rightContent'] = $rightContent;
        $this->renderLeftMenuPageView($vars);
    }

    public function renderProductPageView($vars = []){
        $text = $this->renderTemplate('product_view.php', $vars);
        $vars['text'] = $text;
        $this->renderSimplePageView($vars);
    }
}