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


    public function insert_comment($parentId, $author, $content){
        $query="SELECT * FROM filters";

        //use real_escape_string to prevent SQL Injection Attacks and Cross-site Scripting Attacks
        $parentId = $this->conn->real_escape_string($parentId);
        $author = $this->conn->real_escape_string($author);
        $content = $this->conn->real_escape_string($content);

        $result = $this->conn->query($query);
        if(!$result){
            die($this->conn->error);
        }
        $rows=$result->num_rows;
        for($i=0; $i<$rows; $i++){
            $result->data_seek($i);
            $row = $result->fetch_array(MYSQL_ASSOC);
            $author = str_ireplace($row['word'], $row['replacement'], $author);
            $content = str_ireplace($row['word'], $row['replacement'], $content);
        }

        if($parentId){
            $query ="INSERT INTO comments VALUES(DEFAULT, '$parentId', '$author', NOW(), '$content')";
            $exist=$this->conn->query("SELECT * FROM comments WHERE parentId='$parentId' ");
            if(!$exist->num_rows){
                echo "parentId $parentId does not exist";
                return;
            }
        }else{
            $query ="INSERT INTO comments VALUES(DEFAULT, NULL, '$author', NOW(), '$content')";

        }
        $result = $this->conn->query($query);
        if(!$result){
            die($this->conn->error);
        }
    }

    public function fetch_comments(){
        $query = "SELECT * FROM comments ORDER BY id;";
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
//            echo $comment;
        }
        $result->close();
    }

    public function construct_comment_tree(){
        foreach($this->comments as $id=>$comment){
            $parentId = $comment->parentId;
            if($parentId){
                $this->comments[$parentId]->children[$id]=$comment;
            }
        }
        foreach($this->comments as $id=>$comment){
            $parentId = $comment->parentId;
            if($parentId){
                unset($this->comments[$id]);
            }
        }
    }

    public function finish(){
        $this->conn->close();
    }
}

function display($comments, $indent=0){
    $indent_px = $indent.'px';
    foreach($comments as $id=>$comment){
        $comment_id = 'comment-'.$id;
        echo "<div id=\"$comment_id\" class=\"comment-block\" style=\"margin-left: $indent_px\">";
//        echo "<div></div>"
        echo "<div><strong>$comment->author</strong>  at <strong>$comment->postDate</strong> said: <br></div>";
        echo "<div>$comment->content</div>";
        echo "</div><br>";
        if(!empty($comment->children)){
            display($comment->children, $indent+50);
        }
//        echo "</div>";
    }
}
//
//$comments = new Comments;
//$comments->fetch_comments();
//$comments->construct_comment_tree();
//$comments->finish();
//display($comments->comments);