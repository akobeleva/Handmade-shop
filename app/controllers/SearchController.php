<?php

namespace app\controllers;

use app\models\SearchModel;
use core\Controller;

class SearchController extends Controller
{
    public function __construct()
    {
        $this->model = new SearchModel();
    }

    public function show($_get)
    {
    }
}