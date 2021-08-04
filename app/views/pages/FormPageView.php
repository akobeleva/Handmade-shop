<?php

namespace app\views\pages;

class FormPageView extends PageView
{
    public function renderSignupPage($vars = [])
    {
        $vars['title'] = 'Регистрация';
        $text = $this->renderTemplate('signup_tpl.php', $vars);
        $vars['text'] = $text;
        $this->renderPageContent($vars);
    }

    public function renderLoginPage()
    {
        $vars['title'] = 'Авторизация';
        $text = $this->renderTemplate('login_tpl.php');
        $vars['text'] = $text;
        $this->renderPageContent($vars);
    }
}