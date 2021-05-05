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
        print_r($this->build_tree($postComment));

//        $arr_tree = array();
//        $arr_tmp = array();
//
//        foreach ($postComment as $item) {
//            $parent_id = $item['parent_id'];
//            $id = $item['id'];
//
//            if ($parent_id  == 0)
//            {
//                $arr_tree[$id] = $item;
//                $arr_tmp[$id] = &$arr_tree[$id];
//            }
//            else
//            {
//                if (!empty($arr_tmp[$parent_id]))
//                {
//                    $arr_tmp[$parent_id]['children'][$id] = $item;
//                    $arr_tmp[$id] = &$arr_tmp[$parent_id]['children'][$id];
//                }
//            }
//        }
//
//        unset($arr_tmp);
//        echo '<pre>'; print_r($arr_tree); echo "</pre>";
//        var_dump($postComment);
//        if ($postComment != null) {
//            $references = array();
//            $tree = array();
//            foreach ($postComment as $id => &$node) {
//                // Use id as key to make a references to the tree and initialize it with node reference.
//                $references[$node['id']] = &$node;
//
//                // Add empty array to hold the children/subcategories
//                $node['children'] = array();
////
//                // Get your root node and add this directly to the tree
//                if ($node['parent_id'] == 0) {
//                    $tree[$node['id']] = &$node;
//                } else {
//                    // Add the non-root node to its parent's references
//                    $references[$node['parent_id']]['children'][$node['id']] = &$node;
//                }
//            }
//            print_r($references);

//            print_r($tree);

//        }
//        var_dump($postComment);
//        $array = [];
//
//        foreach ($postComment as $key => $item) {
//            if (empty($array[$item['parent_id']])) {
////                if ()
//                $array[$item['parent_id']] = [];
//                $item['children'] = [];
//                if ($item['id'] == $array[$item['parent_id']]){}
//                $item['children'] = $item;
////                $array['child'] = $item['id'];
//            }
//            $array[$item['parent_id']][] = $item;
//        }
//        echo '<pre>';
//        print_r($array);
//        echo '</pre>';


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
}
