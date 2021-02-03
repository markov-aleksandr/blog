<?php


namespace Application\Controllers;


use Application\Models\ArticleModel;
use Core\Controller;

class ArticleController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->model = new ArticleModel();
    }

    public function actionIndex()
    {
        if (!isset($_SESSION['id'])) {
            header('Location: /');
        } else {
            $this->view->generate("create-view.php", 'templateView.php', $this->model->checkCountUserArticle());

        }

    }
//    public function actionCreate()
//    {
//        $this->view->generate('create-view.php');
//    }

    public function actionCreate()
    {
        var_dump($_SESSION);
        if (!isset($_SESSION['id'])) {
            header('Location: /');
        } else {
            $this->model->createArticle($_POST['title'], $_POST['article']);
            header('Location: /article');
        }
    }

    public function actionView()
    {
        $id = explode('/', $_SERVER['REQUEST_URI']);
        $this->view->generate('user-article-view.php', 'templateView.php', $this->model->getArticleUserId());


    }
}