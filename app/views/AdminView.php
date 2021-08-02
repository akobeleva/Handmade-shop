<?php


namespace app\views;

use core\View;

class AdminView extends View
{
    public function renderAdminView($vars = []){
        echo $this->renderTemplate('admin_tpl.php', $vars);
    }
}