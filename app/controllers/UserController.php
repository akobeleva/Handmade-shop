<?php

namespace app\controllers;

use app\middleware\Validator;
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

    public function showLoginPage()
    {
        $this->view->renderLoginPage();
    }

    public function signup($data)
    {
        $validator = new Validator();
        $messages = $validator->validateRegisterData($data);
        if (isset($data['login']) && UserModel::checkUserByLogin($data['login'])) {
            $messages[] = "Пользователь с таким логином существует!";
        }
        if (isset($data['login']) && UserModel::checkUserByEmail($data['email'])) {
            $messages[] = "Пользователь с таким E-mail существует!";
        }
        $vars = [];
        if (isset($data['login'])) {
            $vars['login'] = $data['login'];
        }
        if (isset($data['password'])) {
            $vars['password'] = $data['password'];
        }
        if (isset($data['email'])) {
            $vars['email'] = $data['email'];
        }
        if (isset($data['username'])) {
            $vars['name'] = $data['username'];
        }
        if (empty($messages)) {
            $newUser = new UserModel(
                $data['login'],
                password_hash($data['password'], PASSWORD_DEFAULT),
                $data['email'],
                $data['username']
            );
            $newUser->save();
            $messages[] = "Вы успешно зарегистрированы :)";
            $vars['message_success'] = $messages;
        } else {
            $vars['message_error'] = $messages;
        }
        $this->view->renderSignupPage($vars);
    }

    public function login($data)
    {
        $messages = [];
        if (isset($data['login']) && UserModel::checkUserByLogin($data['login']))
        {
            $user = UserModel::getUserByLogin($data['login']);
            if ($user) {
                if (password_verify($data['password'], $user->getPassword())) {
                    $_SESSION['logged_user'] = $user->getId();
                    header('Location: /');
                } else {
                    $messages[] = "Пароль введен неверно";
                }
            }
        } else {
            $messages[] = "Пользователь с таким логином не найден";
        }
        if (isset($data['login'])) {
            $vars['login'] = $data['login'];
        }
        if (isset($data['password'])) {
            $vars['password'] = $data['password'];
        }
        $vars['message_error'] = $messages;
        $this->view->renderLoginPage($vars);
    }

    public function logout()
    {
        if (isset($_SESSION['logged_user'])) {
            unset($_SESSION['logged_user']);
            header('Location: /');
        }
    }
}