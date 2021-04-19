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


    public function store($title, $text)
    {
        if (!empty($title) and !empty($text)) {
            $create = $this->dataConnect->prepare('INSERT INTO articles (`user_id`, `title`, `text`) VALUES (:user_id, :title, :article)');
            $create->bindValue(':user_id', $_SESSION['id']);
            $create->bindParam(':title', $title);
            $create->bindParam(':article', $text);
            $create->execute();
        }
    }


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

    public function update($title, $text, $id)
    {
        $editPost = $this->dataConnect->prepare('UPDATE articles SET title = :title, text = :text WHERE id = :id');
        $editPost->bindParam(':title', $title);
        $editPost->bindParam(':text', $text);
        $editPost->bindParam(':id', $id);
        $editPost->execute();
        header("Location: /posts/$id/show");
    }


    public function delete(int $id)
    {
        $deletePost = $this->dataConnect->prepare('DELETE FROM articles WHERE id = :id');
        $deletePost->bindParam(':id', $id);
        $deletePost->execute();
        header("Location: /");
    }


    public function checkCountUserArticle()
    {
        $countUserArticle = $this->dataConnect->prepare('SELECT COUNT(*) FROM articles WHERE user_id = :id');
        $countUserArticle->bindParam(':id', $_SESSION['id']);
        $countUserArticle->execute();
        return $countUserArticle->fetchAll(PDO::FETCH_ASSOC);
    }


    public function addComment($userId, $articleId, $text, $parentId = null)
    {
        $createComment = $this->dataConnect->prepare('INSERT INTO comments(`user_id`, `article_id`, `comment_text`, `parent_id`, `time`) VALUES (:user_id, :article_id, :text, :parent_id, NOW())');
        $createComment->bindParam(':user_id', $userId);
        $createComment->bindParam(':article_id', $articleId);
        $createComment->bindParam(':text', $text);
        $createComment->bindParam(':parent_id', $parentId);
        $createComment->execute();
//        var_dump($createComment->debugDumpParams());
        header("Location: /posts/{$articleId}/show");

    }


    public function getPostComment(int $id)
    {
        $selectComments = $this->dataConnect->prepare('SELECT * FROM comments WHERE article_id = :id ORDER BY time DESC ');
        $selectComments->bindParam(':id', $id);
        $selectComments->execute();
        $posts = $selectComments->fetchAll(PDO::FETCH_ASSOC);
        return $posts;

    }

    public function fetchComment()
    {

    }


}