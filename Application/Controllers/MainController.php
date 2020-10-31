<?php

namespace Application\Controllers;

use Core\Controller;

class MainController extends Controller
{
    public function actionIndex()
    {
        $this->view->generate('mainView.php', 'templateView.php');
    }

}