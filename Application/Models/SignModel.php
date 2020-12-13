<?php

namespace Application\Models;

use Core\Model;

class SignModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function registration($login, $email, $password)
    {
        if (!empty($login) && !empty($email) && !empty($password)) {
            $validationEmail = $this->dataConnect->prepare('SELECT COUNT(*)FROM users WHERE email=:email');
            $validationEmail->bindParam(":email", $email);
            $validationEmail->execute();
            if ($validationEmail->fetchColumn() == '0') {
                $insertRegistrationData = $this->dataConnect->prepare('INSERT INTO users(login, email, password) VALUES (:login, :email, :password)');
                $insertRegistrationData->bindParam(":email", $email);
                $insertRegistrationData->bindParam(":password", $password);
                $insertRegistrationData->bindParam(':login', $login);
                $insertRegistrationData->execute();
            }
        }
    }

}