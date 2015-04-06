<?php
/**
 * Created by PhpStorm.
 * User: calvinmwhu
 * Date: 4/5/15
 * Time: 9:09 PM
 */
require_once 'login.php';

$conn = new mysqli($hn,$un,$pw,$db);
if ($conn->connect_error) die($conn->connect_error);

if (isset($_POST['delete']) && isset($_POST['isbn']))
{
    $isbn   = get_post($conn, 'isbn');
    $query  = "DELETE FROM classics WHERE isbn='$isbn'";
    $result = $conn->query($query);
    if (!$result) echo "DELETE failed: $query<br>" .
        $conn->error . "<br><br>";
}else{
    echo 'delete is not set<br>';
}



?>