<?php
/**
 * Created by PhpStorm.
 * User: calvinmwhu
 * Date: 4/2/15
 * Time: 1:22 AM
 */

class LogEntry {
    public $revision, $author, $date, $msg;
    public $files=array();

    function __construct($logEntry_xml){
        $this->revision = (string)$logEntry_xml['revision'];
        $this->author = (string)$logEntry_xml->author;

//        $this->date = (string)$logEntry_xml->date;
        $temp_date = new DateTime((string)$logEntry_xml->date);
        $this->date = $temp_date->format('Y-m-d H:i:s');

        $this->msg = (string)$logEntry_xml->msg;
        foreach($logEntry_xml->paths->children() as $path){
            $path_name_pieces = array_slice(explode('/',(string)$path), 2) ;
            array_push($this->files,implode('/',$path_name_pieces));
        }
    }
}

