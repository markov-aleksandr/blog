<?php


namespace Application\Controllers;



use Application\Models\AdminModel;
use Core\Controller;

class AdminController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->model = new AdminModel();
    }


}