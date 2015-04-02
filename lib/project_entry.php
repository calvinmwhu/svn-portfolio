<?php
/**
 * Created by PhpStorm.
 * User: calvinmwhu
 * Date: 4/1/15
 * Time: 9:20 PM
 */

include_once 'file_entry.php';

class ProjectEntry {
    public $title, $date, $version, $summary;
    public $files;
    function __construct($assignment_xml){
        $this->title=(string)$assignment_xml->name;
        $this->version = (string)$assignment_xml->commit['revision'];
        $this->date = (string)$assignment_xml->commit->date;
        $this->files=array();
    }

    public function add_file($file){
        $this->files[$file->name]=$file;
    }


}

?>