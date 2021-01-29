<?php


namespace Application\Models;


use Core\Model;

class ArticleModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function createArticle($title, $article)
    {
        if (!empty($title) and !empty($article)) {
            $create = $this->dataConnect->prepare('INSERT INTO articles (`user_id`, `title`, `text`) VALUES (:user_id, :title, :article)');
            $create->bindValue(':user_id', 1);
            $create->bindParam(':title', $title);
            $create->bindParam(':article', $article);
            $create->execute();
        }

    }

    public function getArticleUserId($id)
    {
        $getArticles = $this->dataConnect->prepare('SELECT * FROM articles WHERE user_id = :id');
        $getArticles->bindParam(':id', $id);
        $getArticles->execute();
        $data = $getArticles->fetchAll();
        return $data;
    }

    public function getArticleId($id)
    {
        $getArticles = $this->dataConnect->prepare('SELECT * FROM articles WHERE id = :id');
        $getArticles->bindParam(':id', $id);
        $getArticles->execute();
        $data = $getArticles->fetchAll();
        return $data;
    }

    public function deleteArticle($id)
    {
        $deletePost = $this->dataConnect->prepare('DELETE FROM articles WHERE id = :id');
        $deletePost->bindParam(':id', $id);
        $deletePost->execute();
    }

}