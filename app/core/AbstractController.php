<?php


namespace app\core;


abstract class AbstractController implements indexable
{
    /**
     * @var View
     */
    protected $view;

    protected $model;

    /**
     * AbstractController constructor.
     */
    public function __construct()
    {
        $this->view = new View();
    }

}