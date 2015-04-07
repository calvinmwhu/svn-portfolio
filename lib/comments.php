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
            $exist=$this->conn->query("SELECT * FROM comments WHERE id='$parentId' ");
            if(!$exist->num_rows){
                echo "Id $parentId does not exist";
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

function display($comments, $indent=0, $parentName=null){
    $indent_px = $indent.'px';
    foreach($comments as $id=>$comment){
        $replyButton_id = 'replyButton-'.$id;
        $replyForm_id = 'replyForm-'.$id;
        $words = "said:";
        if($parentName){
            $words = "replied to ".$parentName.":";
        }
        echo "<div class=\"container\" style=\"margin-left: $indent_px\">";

        echo "<div class='user-comment-area'>";
        echo "<div class='profile-image-area'><img class='profile-image' src='www/inc/img/profile.png' alt='profile'/></div>";
        echo "<div class='comment-content'>";
        echo "<div><p class='comment-header'><strong>$comment->author</strong>  at <strong>$comment->postDate</strong> $words <br></p></div>";
        echo "<div><p class='actual-comment'>$comment->content</p></div>";
        echo "<div><button type=\"button\" class=\"reply-button btn-default btn-xs\" id=\"$replyButton_id\">Reply</button></div>";
        echo "</div></div>";

        echo "<div class='row'>";
        //insert html form here for reply
        echo "<form id=\"$replyForm_id\" role=\"form\" method=\"post\" action=\"\"  style='display: none'>";
        echo "<div class=\"form-group required\">";
        echo "<label class=\"control-label\" for=\"name\">Name:</label>";
        echo "<input class=\"form-control\" required=\"required\" type=\"text\" name=\"name\" placeholder=\"your name...\">";
        echo "</div>";
        echo "<div class=\"form-group required\">";
        echo "<label class=\"control-label\" for=\"comment\">Comment:</label>";
        echo "<textarea class=\"form-control\" required=\"required\" name=\"comment\" placeholder=\"your comment...\"rows=\"5\"></textarea>";
        echo "</div>";
        echo "<button type=\"submit\" class=\"btn btn-primary\">Submit</button>";
        echo "</form>";
        echo "</div>";

        echo "</div><br>";

        if(!empty($comment->children)){
            display($comment->children, $indent+50, $comment->author);
        }
    }
}

