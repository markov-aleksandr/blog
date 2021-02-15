<?php


namespace Application\Controllers;


use Application\Models\ArticleModel;
use Core\Controller;

class ArticleController extends Controller
{
    /**
     * ArticleController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->model = new ArticleModel();
    }

    /**
     *
     */
    public function create()
    {
        if (!isset($_SESSION['id'])) {
            header('Location: /');
        } else {
            $this->view->generate("create-view.php", 'templateView.php', $this->model->checkCountUserArticle());
        }
    }

    /**
     *
     */
    public function store()
    {
        if (!isset($_SESSION['id'])) {
            header('Location: /');
        } else {
            $this->model->store($_POST['title'], $_POST['article']);
            header('Location: /posts/create');
        }
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
}
