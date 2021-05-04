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

        return $this->database->columnCount();
    }


    public function getPostComment(int $id)
    {
        $comments = $this->dataConnect->prepare('SELECT u.login, comment_text, article_id, time, parent_id, c.id FROM comments c join users u on u.id = c.user_id where article_id = :id ORDER BY time DESC');
        $comments->bindValue(':id', $id);
        $comments->execute();
        $postComment = $comments->fetchAll(PDO::FETCH_ASSOC);

        if ($postComment != null) {
            $references = array();
            $tree = array();
            foreach ($postComment as $id => &$node) {
                // Use id as key to make a references to the tree and initialize it with node reference.
                $references[$node['id']] = &$node;

                // Add empty array to hold the children/subcategories
                $node['children'] = array();
//
                // Get your root node and add this directly to the tree
                if ($node['parent_id'] == 0) {
                    $tree[$node['id']] = &$node;
                } else {
                    // Add the non-root node to its parent's references
                    $references[$node['parent_id']]['children'][$node['id']] = &$node;
                }
            }
//            return ($references);

//            print_r($tree);

        }
//        $array = [];
//        foreach ($postComment as $item) {
//            if (empty($array[$item['parent_id']])) {
//                $array[$item['parent_id']] = [];
//                $array['child'] = $item['id'];
//            }
//            $array[$item['parent_id']][] = $item;
//        }
////        var_dump($array);]

    }

    public function foo($arr, $level=0) {
        $prepend = str_repeat(' ', $level); // <- the $level thingy is not necessary; it's only in here to get a bit prettier output

        echo $prepend, '<ul>', PHP_EOL;
        foreach($arr as $comment) {
            echo $prepend, '    <li>', $comment['time'], ' ', htmlentities($comment['comment_text']), PHP_EOL;
            if ( !empty($comment['children']) ) {
                $this->foo($comment['children'], $level+1); // recurse into the next level
            }
            echo $prepend, '    </li>', PHP_EOL;
        }
        echo $prepend, '</ul>', PHP_EOL;
    }

}
