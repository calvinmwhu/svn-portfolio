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
        $this->revision = $logEntry_xml['revision'];
        $this->author = $logEntry_xml->author;
        $this->date = $logEntry_xml->date;
        $this->msg = $logEntry_xml->msg;
        foreach($logEntry_xml->paths->children() as $path){
            $path_name_pieces = array_slice(explode('/',$path), 2) ;
            array_push($this->files,implode('/',$path_name_pieces));
        }
    }
}

?>