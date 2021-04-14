<?php


namespace Application\Controllers;


use Application\Models\PostModel;
use Core\Controller;

class PostController extends Controller
{
    /**
     * PostController constructor.
     */
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
        var_dump($this->model->checkCountUserArticle()[0]['COUNT(*)']);

    }

    /**
     * @param int $id
     */
    public function posts(int $id)
    {
        $this->view->generate('article-view.php', 'templateView.php', $this->model->getPostId($id), $this->model->getPostComment($id));
    }

    /**
     * @param int $id
     */
    public function edit(int $id)
    {
        $this->view->generate('edit-view.php', 'templateView.php', $this->model->getPostId($id));
    }

    /**
     * @param int $id
     */
    public function update(int $id)
    {
        $this->model->update($_POST['title'], $_POST['text'], $id);
    }

    /**
     * @param int $id
     */
    public function delete(int $id)
    {
        $this->model->delete($id);
    }

    /**
     * @param int $id
     * @param int|null $parent_id
     */
    public function addComment(int $id, int $parent_id = null)
    {
        $this->model->addComment($id, $_POST['comment'], $parent_id);
    }

    /**
     * @param int $id
     * @return array
     */
    public function userPosts(int $id)
    {
        $this->view->generate('user-article-view.php', 'templateView.php', $this->model->getPostUserId($id));
    }

}
