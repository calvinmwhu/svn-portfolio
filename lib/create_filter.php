<?php
/**
 * Created by PhpStorm.
 * User: calvinmwhu
 * Date: 4/6/15
 * Time: 7:27 PM
 */


require_once 'config.php';

$conn = new mysqli($config['db']['db_localhost']['hostname'], $config['db']['db_localhost']['username'], $config['db']['db_localhost']['password'],$config['db']['db_localhost']['database']);
//$conn = new mysqli($config['db']['db_mhu9']['hostname'], $config['db']['db_mhu9']['username'], $config['db']['db_mhu9']['password'],$config['db']['db_mhu9']['database']);
if ($conn->connect_error) die($conn->connect_error);


$query = "CREATE TABLE IF NOT EXISTS filters(
      word VARCHAR(128) NOT NULL,
      replacement VARCHAR(128) NOT NULL
) ";

$result = $conn->query($query);
if(!$result){
    die($conn->error);
}else{
    echo "database comments created successfully";
}

//
//$query = "INSERT INTO filters VALUES('SHIT', 's***');
//INSERT INTO filters VALUES('FUCK', 'f***');
//INSERT INTO filters VALUES('BITCH', 'b****');
//INSERT INTO filters VALUES('ASSHOLE', 'as**');
//INSERT INTO filters VALUES('DAMN', 'da**');
//";


$result = $conn->query($query);
if(!$result){
    die($conn->error);
}else{
    echo "database comments created successfully";
}




$result->close();
$conn->close();
