<?php


namespace app\controllers;


use app\core\Route;
use app\core\Validator;
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

    public function create()
    {
        $this->view->render('task_create');
    }

    public function store()
    {
        $name = filter_input(INPUT_POST, 'name');//TODO nobody has answer: how working filter_input
        $validator = new Validator();
        if (!$validator->validateName($name)) {
            //TODO send errors
            //TODO send old values
            Route::redirect(Route::url('task','create'));
        }
        $this->model->add([
            'name' => $name,
        ]);
        Route::redirect(Route::url('task','index'));
    }
}