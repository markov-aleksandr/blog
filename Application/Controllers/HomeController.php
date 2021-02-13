<?php

namespace Application\Controllers;

use Application\Models\MainModel;
use Core\Controller;

class HomeController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->model = new MainModel();
    }

    public function index()
    {
        $this->view->generate('mainView.php', 'templateView.php', $this->model->select());
    }
}