<?php


namespace Application\Controllers;


use Application\Models\PostModel;
use Core\Controller;

class PostController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->model = new PostModel();
    }

    public function index()
    {
        $this->view->generate('mainView.php', 'templateView.php', $this->model->index());
    }

    public function store()
    {
        $title = $_POST['title'];
        $text = $_POST['text'];
        return json_encode($this->model->store($title, $text));
    }

    public function create()
    {
        $this->view->generate("create-view.php", 'templateView.php');

    }

    public function posts(int $id)
    {
        $data = ['id' => $id];
        $output = ['posts' => $this->model->getPostComment($data), 'count'=>$this->model->getCountComment($id)];

        $this->view->generate('article-view.php', 'templateView.php', $this->model->getPostId($id), $output);

    }

    public function edit(int $id)
    {
        $this->view->generate('edit-view.php', 'templateView.php', $this->model->getPostId($id));
    }


    public function update(int $id)
    {
        $this->model->update($_POST['title'], $_POST['text'], $id);
    }


    public function delete(int $id)
    {
        $this->model->delete($id);
    }


    public function addComment()
    {
        echo($this->model->addComment($_SESSION['id'], $_POST['articleId'], trim($_POST['comment_content'])));
    }


    public function userPosts(int $id)
    {
        $this->view->generate('user-article-view.php', 'templateView.php', $this->model->getPostUserId($id));
    }

    public function fetchComments (int $id) {
        if (isset($_GET['getAllComments'])) {
            $data = ['id' => $id];
            print_r($this->model->getPostComment($data));
        }
    }

}
