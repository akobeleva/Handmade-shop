<?php

namespace app\views;

use core\View;

class CardView extends View
{
    public function renderBody($vars = [])
    {
        return $this->renderTemplate('card_body_tpl.php', $vars);
    }

    public function renderCard($vars = [])
    {
        return $this->renderTemplate('card_tpl.php', $vars);
    }
}