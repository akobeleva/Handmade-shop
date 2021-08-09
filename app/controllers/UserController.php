<?php

namespace app\controllers;

use app\middleware\Validator;
use app\models\UserModel;
use app\views\pages\UserAccountPageView;
use core\Controller;

class UserController extends Controller
{
    public function __construct()
    {
        $this->view = new UserAccountPageView();
    }

    public function showUserProfilePage()
    {
        if (isset($_SESSION['logged_user'])) {
            $user = UserModel::getById($_SESSION['logged_user']);
            $vars['name'] = $user->getName();
            $vars['login'] = $user->getLogin();
            $vars['email'] = $user->getEmail();
            $leftMenuItems = $this->fillLeftMenuItems();
            $vars['title'] = 'Профиль';
            $vars['leftMenuItems'] = $leftMenuItems;
            $this->view->renderUserProfilePage($vars);
        }
    }

    public function showUserOrdersPage()
    {
        if (isset($_SESSION['logged_user'])) {
            $user = UserModel::getById($_SESSION['logged_user']);
            $leftMenuItems = $this->fillLeftMenuItems();
            $vars['title'] = 'Мои заказы';
            $vars['leftMenuItems'] = $leftMenuItems;
            $this->view->renderUserOrdersPage($vars);
        }
    }

    public function showUserProductsPage()
    {
        if (isset($_SESSION['logged_user'])) {
            $user = UserModel::getById($_SESSION['logged_user']);
            $productController = new ProductController();
            $products = $productController->getProductsBySellerId($user->getId());
            if (!isset($products)){
                $this->showNotFoundPage();
                return;
            }
            $catalogItems = [];
            foreach ($products as $product) {
                $catalogItems[$product->getId()]['entity'] = $product;
            }
            $vars['catalogItems'] = $catalogItems;
            $leftMenuItems = $this->fillLeftMenuItems();
            $vars['title'] = 'Мои товары';
            $vars['leftMenuItems'] = $leftMenuItems;
            $this->view->renderUserProductsPage($vars);
        }
    }

    public function showUserFavoritesPage()
    {
        if (isset($_SESSION['logged_user'])) {
            $user = UserModel::getById($_SESSION['logged_user']);
            $leftMenuItems = $this->fillLeftMenuItems();
            $vars['title'] = 'Избраное';
            $vars['leftMenuItems'] = $leftMenuItems;
            $this->view->renderUserFavoritesPage($vars);
        }
    }

    private function fillLeftMenuItems(): array
    {
        return array(
            array('name' => 'Профиль', 'link' => '/user/profile'),
            array('name' => 'Мои заказы', 'link' => '/user/orders'),
            array('name' => 'Мои товары', 'link' => '/user/products'),
            array('name' => 'Избранное', 'link' => '/user/favorites')
        );
    }

    public function saveProfileSettings($data){
        if (isset($_SESSION['logged_user'])) {
            $user = UserModel::getById($_SESSION['logged_user']);
            $validator = new Validator();
            $messages = $validator->validateProfileSettingsData($data);
            if (isset($data['login']) && $data['login'] != $user->getLogin()
                && UserModel::checkUserByLogin($data['login']))
            {
                $messages[] = "Пользователь с таким логином существует!";
            }
            if (isset($data['login']) && $data['email'] != $user->getEmail()
                && UserModel::checkUserByEmail($data['email']))
            {
                $messages[] = "Пользователь с таким E-mail существует!";
            }
            $vars = [];
            if (isset($data['login'])) {
                $vars['login'] = $data['login'];
            }
            if (isset($data['email'])) {
                $vars['email'] = $data['email'];
            }
            if (isset($data['username'])) {
                $vars['name'] = $data['username'];
            }
            if (empty($messages)) {
                $user->setName($data['username']);
                $user->setLogin($data['login']);
                $user->setEmail($data['email']);
                $user->update();
                $messages[] = "Изменения успешно сохранены :)";
                $vars['message_success'] = $messages;
            } else {
                $vars['message_error'] = $messages;
            }
            $leftMenuItems = $this->fillLeftMenuItems();
            $vars['title'] = 'Профиль';
            $vars['leftMenuItems'] = $leftMenuItems;
            $this->view->renderUserProfilePage($vars);
        }
    }
}