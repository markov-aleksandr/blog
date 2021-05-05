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

        echo json_encode($this->model->store($title, $text, $_SESSION['user']['id']));
    }

    public function create()
    {
//        var_dump($this->model->countUserPosts($_SESSION['id']));
        $data = ['count' => $this->model->countUserPosts($_SESSION['user']['id']), 'posts' => $this->model->getPostUserId($_SESSION['user']['id'])];
        $this->view->generate("create-view.php", 'templateView.php', $data);
    }

    public function posts(int $id)
    {
//        $data = ['id' => $id];
//        $output = ['posts' => $this->model->getPostComment($id), 'count' => $this->model->getCountComment($id)];
//$array = $this->model->getPostComment(1);
//        var_dump($this->model->renderAllComment($array));

        $this->view->generate('article-view.php', 'templateView.php', $this->model->getPostId($id), $this->model->getPostComment($id));
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

        echo($this->model->addComment($_SESSION['user']['id'], $_POST['articleId'], trim($_POST['comment_content']), ($_POST['parentId'] == 0 ? null : $_POST['parentId'])));
    }


    public function userPosts(int $id)
    {
        $this->view->generate('user-article-view.php', 'templateView.php', $this->model->getPostUserId($id));
    }

    public function fetchComments(int $id)
    {
        echo json_encode($this->model->getPostComment($id));
//        if (isset($_GET['getAllComments'])) {
////            $data = ['id' => $id];
//            echo json_encode($this->model->getPostComment($id));
//        }
    }

}
