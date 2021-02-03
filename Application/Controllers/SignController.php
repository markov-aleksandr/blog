<?php


namespace Application\Controllers;


use Application\Models\UserModel;
use Core\Controller;

class SignController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->model = new UserModel();
    }

    public function actionIndex()
    {
        $this->view->generate('sign-view.php');
    }

    public function actionLogin()
    {


        $this->view->generate('login-view.php');
    }

    public function actionRegistration()
    {
        $this->model->registration($_POST['login'], $_POST['email'], $_POST['password']);
    }

    public function actionAutorization()
    {
//      if ($this->model->login($_POST['email'], $_POST['password'])){
          $response = $this->model->login($_POST['email'], $_POST['password']);
          echo $response;
      }
}