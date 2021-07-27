<?php

namespace app\controllers;
use app\views\pages\SignupPageView;
use core\Controller;

class UserController extends Controller
{
    public function __construct(){
        $this->view = new SignupPageView();
    }

    public function signup(){
        $this->view->renderSignupPage();
    }

    public function login(){

    }

    public function logout(){

    }
}