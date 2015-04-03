<?php
/**
 * Created by PhpStorm.
 * User: calvinmwhu
 * Date: 4/1/15
 * Time: 9:20 PM
 */

include_once 'file_entry.php';

/**
 * Class ProjectEntry--Defines an assignment directory
 * Contains an array of all the files and sub-directories under this directory
 */
class ProjectEntry {
    public $title, $date, $version, $summary;
    public $files;
    function __construct($assignment_xml){
        $this->title=(string)$assignment_xml->name;
        $this->version = (string)$assignment_xml->commit['revision'];
        $this->date = (string)$assignment_xml->commit->date;
        $this->files=array();
    }

    /**
     * @param $file -- a FileEntry object
     * add this file to the project
     *
     */
    public function add_file($file){
        $this->files[$file->name]=$file;
    }

    /**
     * @param $log_entries -- an array of LogEntry objects
     */
    public function add_summary($log_entries){
        $this->summary=$log_entries[$this->version]->msg;
    }

}

