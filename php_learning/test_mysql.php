<?php
/**
 * Created by PhpStorm.
 * User: calvinmwhu
 * Date: 3/28/15
 * Time: 1:19 PM
 */
require_once 'login.php';

//echo "lets do this!";

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) {
    die($conn->connect_error);
} else {
    echo 'connect successful';
}

$query = 'SELECT * FROM classics';
$result = $conn->query($query);
if(!$result) die ($conn->error);

function mysql_fatal_error($msg)
{
    $msg2 = mysql_error();
    echo <<< _END
       We are sorry, but it was not possible to complete
       the requested task. The error message we got was:
           <p>$msg: $msg2</p>
       Please click the back button on your browser
       and try again. If you are still having problems,
       please <a href="mailto:admin@server.com">email
       our administrator</a>. Thank you.
_END;

}

?>