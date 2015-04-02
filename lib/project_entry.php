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
        $this->title=$assignment_xml->name;
        $this->version = $assignment_xml->commit['revision'];
        $this->date = $assignment_xml->commit->date;
        $this->files=array();
    }

    public function add_file($file){
        $this->files[$file->$path]=$file;
    }


}

?>