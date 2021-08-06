<?php

namespace app\controllers;

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
}