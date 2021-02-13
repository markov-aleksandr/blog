<?php


namespace Application\Models;


use Core\Model;

class ArticleModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function store($title, $article)
    {
        if (!empty($title) and !empty($article)) {
            $create = $this->dataConnect->prepare('INSERT INTO articles (`user_id`, `title`, `text`) VALUES (:user_id, :title, :article)');
            $create->bindValue(':user_id', $_SESSION['id']);
            $create->bindParam(':title', $title);
            $create->bindParam(':article', $article);
            $create->execute();
        }

    }

    public function getPostId(int $id)
    {
        $getArticles = $this->dataConnect->prepare('SELECT * FROM articles WHERE id = :id');
        $getArticles->bindParam(':id', $id);
        $getArticles->execute();
        return $getArticles->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function deletePost($id)
    {
        $deletePost = $this->dataConnect->prepare('DELETE FROM articles WHERE id = :id');
        $deletePost->bindParam(':id', $id);
        $deletePost->execute();
    }

    public function checkCountUserArticle()
    {
        $countUserArticle = $this->dataConnect->prepare('SELECT COUNT(*) FROM articles WHERE user_id = :id');
        $countUserArticle->bindParam(':id', $_SESSION['id']);
        $countUserArticle->execute();
        return $countUserArticle->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function createComment($articleId, $text, $parentId)
    {
        $createComment = $this->dataConnect->prepare('INSERT INTO comments(user_id, article_id, text, parent_id) VALUES (:user_id, :article_id, :text, :parent_id)');
        $createComment->bindParam(':user_id', $_SESSION['id']);
        $createComment->bindParam(':article_id', $articleId);
        $createComment->bindParam(':text', $text);
        $createComment->bindParam(':parent_id', $parentId);
        $createComment->execute();
//        var_dump($this->getArticleId());
    }

    public function getComments($id)
    {
        $selectComments = $this->dataConnect->prepare('SELECT * FROM comments WHERE article_id = :id');
        $selectComments->bindParam(':id', $id);
        $selectComments->execute();
        return $selectComments->fetchAll(\PDO::FETCH_ASSOC);

    }
}