<?php


namespace app\controllers;


use app\core\DBException;
use app\core\NotFoundException;
use app\core\Route;
use app\core\Validator;
use app\models\TaskModel;

class TaskController extends \app\core\AbstractController
{
    public function __construct()
    {
        parent::__construct();
        try{
            $this->model = new TaskModel();
        }catch (DBException $e){
            var_dump($e->getMessage());
            exit();
        }

    }

    public function index()
    {
        $tasks = $this->model->all();
        $this->view->render(
            'task_index',
            [
                'tasks' => $tasks,
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

    public function destroy()
    {
        $id = filter_input(INPUT_POST, 'id');
        if(!$this->model->getById($id)){
            throw new NotFoundException();
        }
        $this->model->delete($id);
        Route::redirect(Route::url('task','index'));
    }
}