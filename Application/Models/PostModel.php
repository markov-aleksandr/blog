<?php


namespace Application\Models;


use Core\Model;
use PDO;

class PostModel extends Model
{
    /**
     * ArticleModel constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $fetchPosts = $this->dataConnect->query('SELECT * FROM articles');
        return $fetchPosts->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @param $title
     * @param $text
     */
    public function store($title, $text)
    {
        if (!empty($title) and !empty($text)) {
            $create = $this->dataConnect->prepare('INSERT INTO articles (`user_id`, `title`, `text`) VALUES (:user_id, :title, :article)');
            $create->bindValue(':user_id', $_SESSION['id']);
            $create->bindParam(':title', $title);
            $create->bindParam(':article', $text);
            $create->execute();
            return $this->checkCountUserArticle()[0]['COUNT(*)'];
        }
    }

    /**
     * @param int $id
     * @return array
     */
    public function getPostId(int $id)
    {
        $getArticles = $this->dataConnect->prepare('SELECT * FROM articles WHERE id = :id');
        $getArticles->bindParam(':id', $id);
        $getArticles->execute();
        return $getArticles->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPostUserId(int $id)
    {
        $getArticles = $this->dataConnect->prepare('SELECT * FROM articles WHERE user_id = :id');
        $getArticles->bindParam(':id', $id);
        $getArticles->execute();
        return $getArticles->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @param $title
     * @param $text
     * @param $id
     */
    public function update($title, $text, $id)
    {
        $editPost = $this->dataConnect->prepare('UPDATE articles SET title = :title, text = :text WHERE id = :id');
        $editPost->bindParam(':title', $title);
        $editPost->bindParam(':text', $text);
        $editPost->bindParam(':id', $id);
        $editPost->execute();
        header("Location: /posts/$id/show");
    }

    /**
     * @param int $id
     */
    public function delete(int $id)
    {
        $deletePost = $this->dataConnect->prepare('DELETE FROM articles WHERE id = :id');
        $deletePost->bindParam(':id', $id);
        $deletePost->execute();
        header("Location: /");
    }

    /**
     * @return array
     */
    public function checkCountUserArticle()
    {
        $countUserArticle = $this->dataConnect->prepare('SELECT COUNT(*) FROM articles WHERE user_id = :id');
        $countUserArticle->bindParam(':id', $_SESSION['id']);
        $countUserArticle->execute();
        return $countUserArticle->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @param $articleId
     * @param $text
     * @param null $parentId
     */
    public function addComment($articleId, $text, $parentId = 0)
    {
        $createComment = $this->dataConnect->prepare('INSERT INTO comments(`user_id`, `article_id`, `comment_text`, `parent_id`, `time`) VALUES (:user_id, :article_id, :text, :parent_id, NOW())');
        $createComment->bindParam(':user_id', $_SESSION['id']);
        $createComment->bindParam(':article_id', $articleId);
        $createComment->bindParam(':text', $text);
        $createComment->bindParam(':parent_id', $parentId);
        $createComment->execute();
        var_dump($createComment->debugDumpParams());
        var_dump($_POST);
        header("Location: /posts/{$articleId}/show");

    }

    /**
     * @param int $id
     * @return array
     */
    public function getPostComment(int $id)
    {
        $selectComments = $this->dataConnect->prepare('SELECT * FROM comments WHERE article_id = :id ORDER BY time DESC ');
        $selectComments->bindParam(':id', $id);
        $selectComments->execute();
        return $selectComments->fetchAll(PDO::FETCH_ASSOC);

    }

}