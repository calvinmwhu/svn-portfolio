<?php
/**
 * Created by PhpStorm.
 * User: calvinmwhu
 * Date: 4/5/15
 * Time: 11:24 PM
 */


require_once 'config.php';

$conn = new mysqli($config['db']['db_localhost']['hostname'], $config['db']['db_localhost']['username'], $config['db']['db_localhost']['password'],$config['db']['db_localhost']['database']);
//$conn = new mysqli($config['db']['db_mhu9']['hostname'], $config['db']['db_mhu9']['username'], $config['db']['db_mhu9']['password'],$config['db']['db_mhu9']['database']);
if ($conn->connect_error) die($conn->connect_error);


$query = "SELECT * FROM classics";
$result = $conn->query($query);
if (!$result) die($conn->error);

$rows = $result->num_rows;
for ($j = 0; $j < $rows; ++$j) {
    $result->data_seek($j);
    $row = $result->fetch_array(MYSQL_ASSOC);

    echo 'Author: '.$row['author'].'<br>';
    echo 'Title: '.$row['title'].'<br>';
    echo 'Type: '.$row['type'].'<br>';
    echo 'Year: '.$row['year'].'<br><br>';

}
$result->close();
$conn->close();


?>
