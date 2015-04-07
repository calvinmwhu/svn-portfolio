<?php
/**
 * Created by PhpStorm.
 * User: calvinmwhu
 * Date: 4/2/15
 * Time: 12:39 AM
 */

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    echo "<h1>$data</h1>";
    return $data;
}

echo test_input("<script>location.href('http://www.hacked.com')</script>");