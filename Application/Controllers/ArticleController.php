<?php


namespace Application\Controllers;


use Application\Models\ArticleModel;
use Core\Controller;

class ArticleController extends Controller
{
    public $params;
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
        $this->view->generate('article-view.php', 'templateView.php', $this->model->getArticleId($id['3']));


    }
}