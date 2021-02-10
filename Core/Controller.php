<?php


namespace Core;


class Controller
{
    public $model;
    public $view;
    public $params;

    public function __construct()
    {
        $this->view = new View();
        var_dump($this->params);
    }

}