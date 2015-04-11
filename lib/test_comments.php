<?php

require_once 'comments.php';
//require_once 'create_db_for_tests.php';

class CommentsTest extends PHPUnit_Framework_TestCase
{
    public function testInsertCommentsValid()
    {
        require 'create_db_for_tests.php';
        $comments = new Comments;
        $comments->conn = $connection;
        $comments->insert_comment('3', 'mhu9', 'this is author mhu9');
        $query = "SELECT * FROM comments WHERE id=4";
        $result = $comments->conn->query($query);
        $this->assertEquals(1, $result->num_rows);
        $result->data_seek(0);
        $row = $result->fetch_array(MYSQL_ASSOC);
        $this->assertEquals($row['parentId'], 3);
        $this->assertEquals($row['author'], 'mhu9');
        $this->assertEquals($row['content'], 'this is author mhu9');
    }

    public function testInsertCommentsInvalid()
    {
        require 'create_db_for_tests.php';
        $comments = new Comments;
        $comments->conn = $connection;
        $comments->insert_comment('5', 'mhu9', 'this is author mhu9');
        $query = "SELECT * FROM comments WHERE id=4";
        $result = $comments->conn->query($query);
        $this->assertEquals(0, $result->num_rows);
    }

    public function testFetchComments()
    {
        require 'create_db_for_tests.php';
        $comments = new Comments;
        $comments->conn = $connection;
        $comments->fetch_comments();
        $this->assertEquals(count($comments->comments), 3);
    }


}

?>