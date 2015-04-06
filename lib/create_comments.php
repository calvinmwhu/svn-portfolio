<?php
/**
 * Created by PhpStorm.
 * User: calvinmwhu
 * Date: 4/5/15
 * Time: 11:58 PM
 */


require_once 'config.php';

$conn = new mysqli($config['db']['db_localhost']['hostname'], $config['db']['db_localhost']['username'], $config['db']['db_localhost']['password'],$config['db']['db_localhost']['database']);
//$conn = new mysqli($config['db']['db_mhu9']['hostname'], $config['db']['db_mhu9']['username'], $config['db']['db_mhu9']['password'],$config['db']['db_mhu9']['database']);
if ($conn->connect_error) die($conn->connect_error);


$query = "CREATE TABLE IF NOT EXISTS comments(
      id int NOT NULL AUTO_INCREMENT KEY,
      parentId int,
      author VARCHAR(128) NOT NULL ,
      postDate  DATETIME NOT NULL,
      content TEXT(200) NOT NULL
) ";

$result = $conn->query($query);
if(!$result){
    die($conn->error);
}else{
    echo "database comments created successfully";
}


$result->close();
$conn->close();
