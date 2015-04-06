<?php
/**
 * Created by PhpStorm.
 * User: calvinmwhu
 * Date: 4/5/15
 * Time: 11:55 PM
 */


class Comment{
    public $id, $parentId, $author, $postDate, $content;
    public $children;
    function __construct($row){
        $this->id = $row['id'];
        $this->parentId=$row['parentId'];
        $this->author=$row['author'];
        $this->postDate=$row['postDate'];
        $this->content=$row['content'];
        $this->children=array();
    }
    public function __toString() {
        return "[id: $this->id, parentId: $this->parentId, author: $this->author, postDate: $this->postDate, content: $this->content]<br>";
    }
}



class Comments
{
    public $comments;
    public  $conn;

    function __construct()
    {
        require_once 'config.php';
        $this->conn = new mysqli($config['db']['db_localhost']['hostname'], $config['db']['db_localhost']['username'], $config['db']['db_localhost']['password'], $config['db']['db_localhost']['database']);
        //$conn = new mysqli($config['db']['db_mhu9']['hostname'], $config['db']['db_mhu9']['username'], $config['db']['db_mhu9']['password'],$config['db']['db_mhu9']['database']);
        if ($this->conn->connect_error) die($this->conn->connect_error);
        $this->comments = array();
    }

    public function populate(){
        $this->fetch_comments();
    }

    public function finish(){
        $this->conn->close();
    }

    public function fetch_comments(){
        $query = "SELECT * FROM comments";
        $result = $this->conn->query($query);
        if(!$result){
            die($this->conn->error);
        }
        $rows = $result->num_rows;
        for($i=0; $i<$rows; $i++){
            $result->data_seek($i);
            $row = $result->fetch_array(MYSQL_ASSOC);
            $comment = new Comment($row);
            $this->comments[$comment->id]=$comment;
            echo $comment;
        }
        $result->close();
    }

    public function construct_comment_tree(){
        
    }


}

$comments = new Comments;
$comments->populate();
$comments->finish();