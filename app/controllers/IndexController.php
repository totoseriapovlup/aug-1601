<?php


namespace app\controllers;

use app\core\AbstractController;

class IndexController extends AbstractController
{

    public function index()
    {
        $this->view->render('index_index');
    }
}