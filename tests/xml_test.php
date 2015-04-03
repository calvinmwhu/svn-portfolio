<?php
$xml = simplexml_load_file("note.xml") or die("Error: Cannot create object");
//print_r($xml);

echo $xml->to;
echo $xml->from;
echo $xml->heading;

phpinfo();

?>