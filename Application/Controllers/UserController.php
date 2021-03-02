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
        $this->view->generate('sign-view.php');
    }

    public function login()
    {
        $this->view->generate('login-view.php');
    }

//    public function signup()
//    {
//        $login = $_POST['login'];
//        $email = $_POST['email'];
//        $password = $_POST['password'];
//        var_dump($this->model->signup($login, $email, $password));
//    }

//    public function signup()
//    {
//        $data = [
//            "title" => $_POST['title'],
//            "text" => $_POST['text']
//        ];
//
//        $connection = new \PDO('mysql:host=localhost;dbname=exmpl', 'root', 'root');
//        $statment = $connection->prepare('INSERT INTO posts (title, text) VALUES(:title, :text)');
//        $result = $statment->execute($data);
//        var_dump($result);
//
//    }

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