<?php


namespace Application\Controllers;

use Application\Models\UserModel;
use Core\Controller;

class UserController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->model = new UserModel();
    }

    public function join()
    {
        var_dump($_POST);
        $this->view->generate('sign-view.php');
    }

    public function login()
    {
        $this->view->generate('login-view.php');
    }

    public function signup()
    {
        $login = $_POST['login'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        return $this->model->signup($login, $email, $password);
    }


    public function authorize()
    {
        $response = $this->model->login($_POST['email'], $_POST['password']);
        echo $response;
    }

    public function logout()
    {
        unset($_SESSION['session_username']);
        session_destroy();
        header("location: /");
    }


}