<?php
/**
 * Created by PhpStorm.
 * User: calvinmwhu
 * Date: 4/10/15
 * Time: 11:39 PM
 */

$connection = new mysqli('localhost', 'newuser', 'newuser', 'test_portfolio');

if($connection->connect_error){
    die($connection->connect_error);
}else{
    print_r("database connected!");
}


    $connection->query("TRUNCATE comments");
    $connection->query("insert into comments  values(1, NULL, 'a1', NOW(),'comment1')");
    $connection->query("insert into comments  values(2, NULL, 'a2', NOW(),'comment2')");
    $connection->query("insert into comments  values(3, NULL, 'a3', NOW(),'comment3')");



