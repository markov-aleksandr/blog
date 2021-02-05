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

    public function actionUserView()
    {
        $id = explode('/', $_SERVER['REQUEST_URI']);
        $this->view->generate('user-article-view.php', 'templateView.php', $this->model->getArticleUserId());
    }

    public function actionPost()
    {
        $id = explode('/', $_SERVER['REQUEST_URI']);
        $this->view->generate('article-view.php', 'templateView.php',  $this->model->getArticleId($id[3]));
    }

    public function actionComment()
    {
        $id = explode('/', $_SERVER['REQUEST_URI']);
        $this->model->createComment($id[3], $_POST['comment'], null);
        header("Location: /article/post/{$id[3]}");
    }
}