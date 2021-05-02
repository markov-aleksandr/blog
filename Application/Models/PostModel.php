<?php


namespace Application\Models;


use Core\Database;
use Core\Model;
use PDO;

class PostModel extends Model
{
    private $database;

    /**
     * ArticleModel constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->database = new Database();
    }

    public function index()
    {
        $fetchPosts = $this->dataConnect->query('SELECT * FROM articles ORDER BY id DESC');

        return $fetchPosts->fetchAll(PDO::FETCH_ASSOC);
    }


    public function store($title, $text, $id)
    {
        if (!empty($title) and !empty($text)) {
            $create = $this->dataConnect->prepare('INSERT INTO articles (`user_id`, `title`, `text`, `date_create`) VALUES (:user_id, :title, :article, now())');
            $create->bindValue(':user_id', $id);
            $create->bindParam(':title', $title);
            $create->bindParam(':article', $text);
            $create->execute();

            return $data = ['count' => $this->countUserPosts($id), 'posts' => $this->getPostUserId($id)];
        }
    }


    public function getPostId(int $id)
    {
        $getArticles = $this->dataConnect->prepare('SELECT * FROM articles WHERE id = :id');
        $getArticles->bindParam(':id', $id);
        $getArticles->execute();


        return $getArticles->fetch(PDO::FETCH_ASSOC);
    }

    public function getPostUserId(int $id)
    {
        $this->database->query('SELECT * FROM articles WHERE user_id = :id');
        $this->database->bind(':id', $id);

        return $this->database->resultSet();
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


    public function countUserPosts($id)
    {
        $this->database->query('SELECT COUNT(*) FROM articles WHERE user_id = :id');
        $this->database->bind(':id', $id);

        return $this->database->fetchColumn();

    }


    public function addComment($userId, $articleId, $text, $parentId = null)
    {
        $this->database->query('INSERT INTO comments(`user_id`, `article_id`, `comment_text`, `parent_id`, `time`) VALUES (:user_id, :article_id, :text, :parent_id, NOW())');
        $this->database->bind(':user_id', $userId);
        $this->database->bind(':article_id', $articleId);
        $this->database->bind(':text', $text);
        $this->database->bind(':parent_id', $parentId);
        $this->database->execute();
        $id = ['id' => $articleId];
        $data = ['count' => $this->getCountComment($articleId), 'comments' => $this->getPostComment($articleId)];

        return json_encode($data);
    }

    public function getCountComment($id)
    {
        $this->database->query("SELECT COUNT(*) FROM comments WHERE article_id = :id");
        $this->database->bind(':id', $id);

        return $this->database->fetchColumn();
    }

    public function getPostComment($id)
    {
        $this->database->query('SELECT u.login, comment_text, article_id, time, parent_id, c.id FROM comments c join users u on u.id = c.user_id where article_id = :id ORDER BY time DESC limit 0, 20');
        $this->database->bind(':id', $id);
        $postComment = $this->database->resultSet();
//        var_dump($postComment);
        $parent = [];
        $child = [];
        foreach ($postComment as $item) {
            if ($item['parent_id'] == 13) {
                $parent[$item['id']] = $item;
                var_dump($parent);
            }
        }

    }
}
