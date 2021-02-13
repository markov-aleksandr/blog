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

    public function create()
    {
        if (!isset($_SESSION['id'])) {
            header('Location: /');
        } else {
            $this->view->generate("create-view.php", 'templateView.php');
        }
    }

    public function store()
    {
        if (!isset($_SESSION['id'])) {
            header('Location: /');
        } else {
            $this->model->store($_POST['title'], $_POST['article']);
            header('Location: /posts/create');
        }
    }

    public function posts(int $id)
    {
        $this->view->generate('article-view.php', 'templateView.php', $this->model->getPostId($id));
    }

    public function edit(int $id)
    {

    }
}
