<?php


namespace Application\Controllers;

use Application\Models\UserModel;
use Core\Controller;
use Core\Mailer;

class UserController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->model = new UserModel();
    }

    public function admin () {
        $this->view->generate('admin-view.php', 'templateView.php', $this->model->getAllUserPost());
}

    public function join()
    {
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
        echo($this->model->signup($login, $email, $password));
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

    public function userActivation(string $hash)
    {
        var_dump($hash);
        var_dump($this->model->activation($hash));
    }

    public function sendSecurityCode($hash)
    {
        $user_email = "uioptoday@gmail.com";
        $name = "Александр Державский";
        $mailer = new Mailer();
        $send = $mailer->sendSecurityCodeEmail($user_email, $name, $hash);
    }


}