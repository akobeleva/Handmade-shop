<?php

namespace app\controllers;

use app\models\SearchModel;
use core\Controller;
use core\View;

class SearchController extends Controller
{
    public function __construct()
    {
        $this->view = new View();
        $this->model = new SearchModel();
    }

    public function show($_get)
    {
    }
}