<?php


namespace app\controllers;


use app\models\TaskModel;

class TaskController extends \app\core\AbstractController
{
    public function __construct()
    {
        parent::__construct();
        $this->model = new TaskModel();
    }

    public function index()
    {
//        $this->model->all();
        $this->view->render(
            'task_index',
            [
                'tasks' => [],
            ]
        );
    }
}