<?php

namespace app\controllers;

use app\models\UserModel;
use app\views\pages\FormPageView;
use core\Controller;

class UserController extends Controller
{
    public function __construct()
    {
        $this->view = new FormPageView();
    }

    public function showSignupPage()
    {
        $this->view->renderSignupPage();
    }

    public function signup( $_post)
    {
        $messages = array();
        if (isset($_post['login'])) {
            if (trim($_post['login']) == "") {
                $messages[] = "Введите логин";
            }
            if (mb_strlen($_post['login']) < 5 || mb_strlen($_post['login']) > 90) {
                $messages[] = "Недопустимая длина логина";
            }
            if (UserModel::checkUserByLogin($_post['login'])) {
                $messages[] = "Пользователь с таким логином существует!";
            }
        }
        if (isset($_post['password'])) {
            if (trim($_post['password']) == "") {
                $messages[] = "Введите пароль";
            }
            if (mb_strlen($_post['password']) < 6 || mb_strlen(($_post['password']) > 20)) {
                $messages[] = "Недопустимая длина пароля";
            }
        }
        if (isset($_post['email'])) {
            if (trim($_post['email']) == "") {
                $messages[] = "Введите E-mail";
            }
            if (!preg_match(
                "/[0-9a-z_]+@[0-9a-z_^]+\.[a-z]{2,3}/i",
                $_post['email']
            )
            ) {
                $messages[] = 'Неверно введен E-mail';
            }
            if (UserModel::checkUserByEmail($_post['email'])) {
                $messages[] = "Пользователь с таким E-mail существует!";
            }
        }
        if (isset($_post['username'])) {
            if (trim($_post['username']) == "") {
                $messages[] = "Введите имя пользователя";
            }
            if (mb_strlen($_post['username']) < 4 || mb_strlen(($_post['username']) > 30)) {
                $messages[] = "Недопустимая длина имени пользователя";
            }
        }
        $vars = [];
        $vars['login'] = $_post['login'];
        $vars['password'] = $_post['password'];
        $vars['email'] = $_post['email'];
        $vars['name'] = $_post['username'];
        if (empty($messages)){
            $newUser = new UserModel($_post['login'], password_hash($_post['password'], PASSWORD_DEFAULT), $_post['email'], $_post['username']);
            $newUser->save();
            $messages[] = "Вы успешно зарегистрированы :)";
            $vars['message_success'] = $messages;
        }
        else {
            $vars['message_error'] = $messages;
        }
        $this->view->renderSignupPage($vars);
    }

    public function login()
    {
    }

    public function logout()
    {
    }
}