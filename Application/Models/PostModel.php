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

        return $this->database->rowCount();

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
        $this->database->query("SELECT * FROM comments WHERE article_id = :id");
        $this->database->bind(':id', $id);
//var_dump($this->database->execute());
        return $this->database->columnCount();
    }


    public function getPostComment(int $id)
    {        #echo '<pre>';
        $comments = $this->dataConnect->prepare('SELECT u.login, comment_text, article_id, time, parent_id, c.id FROM comments c join users u on u.id = c.user_id where article_id = :id ORDER BY time DESC');
        $comments->bindValue(':id', $id);
        $comments->execute();
        $postComment = $comments->fetchAll(PDO::FETCH_ASSOC);

        return $this->build_tree($postComment);
    }

    private function build_tree(&$items, $parentId = null) {
        $treeItems = [];
        foreach ($items as $idx => $item) {
            if((empty($parentId) && empty($item['parent_id'])) || (!empty($item['parent_id']) && !empty($parentId) && $item['parent_id'] == $parentId)) {
                $items[$idx]['children'] = $this->build_tree($items, $items[$idx]['id']);
                $treeItems []= $items[$idx];
            }
        }

        return $treeItems;
    }

    public function commentView($arr, $level=0) {
//        $prepend = str_repeat(' ', $level); // <- the $level thingy is not necessary; it's only in here to get a bit prettier output

        echo '<ul>', PHP_EOL;
        foreach($arr as $comment) {
            echo '<li style="list-style-type: none;"> <span class="user">'.$comment['login'].' </span><span class="time">', $comment['time'], '</span> ', '<span class="userComment">',htmlentities($comment['comment_text']), '</span>', PHP_EOL;
            echo '<div class="reply" id="'.$comment['id'].'"><a href="javascript:void(0)">ответить</a></div>';

            if ( !empty($comment['children']) ) {
                $this->commentView($comment['children'], $level+1); // recurse into the next level
            }
            echo '</li>', PHP_EOL;
        }
        echo '</ul>', PHP_EOL;
    }
}
