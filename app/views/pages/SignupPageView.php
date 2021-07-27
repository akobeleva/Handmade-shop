<?php

namespace app\views\pages;

class SignupPageView extends PageView
{
    public function renderSignupPage(){
        $vars['title'] = 'Регистрация';
        $text = $this->renderTemplate('signup_tpl.php');
        $vars['text'] = $text;
        $this->renderPageContent($vars);
    }
}