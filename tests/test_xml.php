<?php
/**
 * Created by PhpStorm.
 * User: calvinmwhu
 * Date: 4/2/15
 * Time: 12:39 AM
 */

$xml=simplexml_load_file("books.xml") or die("Error: Cannot create object");
$test_string = $xml->book[0]['category'];

if($test_string=='COOKING'){
    echo $test_string;
}