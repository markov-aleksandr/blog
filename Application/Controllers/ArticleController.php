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
        $this->view->generate("create-view.php");

    }

    public function actionCreate()
    {
        $this->model->createArticle($_POST['title'], $_POST['article']);
        var_dump($_POST);
        die();
        header('Location: /');
    }

    public function actionView()
    {
        $id = explode('/', $_SERVER['REQUEST_URI']);
        if (!empty($id['4'])) {
            $this->view->generate('article-view.php', 'templateView.php', $this->model->getArticleId($id['4']));
        } else {
            $this->view->generate('userArticle-view.php', 'templateView.php', $this->model->getArticleUserId($id['3']));
        }

    }

    public function actionDelete()
    {
        $id = explode('/', $_SERVER['REQUEST_URI']);
        $this->model->deleteArticle($id['4']);
        header('Location: /');
    }


}