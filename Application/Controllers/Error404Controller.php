<?php

namespace Application\Controllers;

use Core\Controller;

class Error404Controller extends Controller
{
    public function actionIndex()
    {
        $this->view->generate('404-view.php', 'templateView.php');
    }
}