<?php

namespace Application\Models;

use Core\Model;
use PDO;
use Application\Models\UserTabelGateway;

class UserModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function test() {
    }

    public function registration($login, $email, $password)
    {
        if (!empty($login) && !empty($email) && !empty($password)) {
            $validationEmail = $this->dataConnect->prepare('SELECT COUNT(*)FROM users WHERE email=:email');
            $validationEmail->bindParam(":email", $email);
            $validationEmail->execute();
            if ($validationEmail->fetchColumn() == '0') {
                $password = password_hash($password, PASSWORD_DEFAULT);
                $insertRegistrationData = $this->dataConnect->prepare('INSERT INTO users(login, email, password) VALUES (:login, :email, :password)');
                $insertRegistrationData->bindParam(":email", $email);
                $insertRegistrationData->bindParam(":password", $password);
                $insertRegistrationData->bindParam(':login', $login);
                $insertRegistrationData->execute();
            }
        }
    }

    public function login($email, $password)
    {
        if (!empty($email) && !empty($password)) {
            $existenceUser = $this->dataConnect->prepare('SELECT COUNT(*) FROM users WHERE email=:email');
            $existenceUser->bindParam(":email", $email);
            $existenceUser->execute();
            if ($existenceUser->fetchColumn() != 0) {
                $userInfo = $this->dataConnect->prepare('SELECT * FROM users WHERE email=:email');
                $userInfo->bindParam(":email", $email);
                $userInfo->execute();
                $userInfo = $userInfo->fetchAll(PDO::FETCH_ASSOC);
                if (password_verify($password, $userInfo[0]['password'])) {
                    $_SESSION['id'] = $userInfo[0]['id'];
                    if ($userInfo[0]['admin'] == 1) {
                       header('Location: /admin');
                   } else {
                        header('Location: /article/userView');
                   }

                } else {
                    $error = 'Вы ввели не правильный пароль';
                    return $error;
                }
            } else {
                $error = 'Такого пользователя нет.';
                return $error;
            }
        }
    }

}