<?php
/**
 * Created by PhpStorm.
 * User: calvinmwhu
 * Date: 4/1/15
 * Time: 12:14 AM
 */

/**
 * Class Version -- Defines a version of a file
 */
class Version{
    public $number, $author,  $info, $date;

    function __construct($revision, $author, $msg, $date){
        $this->number=$revision;
        $this->author=$author;
        $this->info=$msg;
        $this->date=$date;
    }
}

/**
 * Class FileEntry -- Defines a file or subdirectory under an assignment directory
 * Contains an array of Versions: the previous versions of this file or subdirectory
 */
class FileEntry {
    public $size=0, $type, $path, $versions;
    public $name;
    function __construct($file_xml, $root_path){
        $this->name = (string)$file_xml->name;
        $ext = pathinfo($this->name, PATHINFO_EXTENSION);
        if($file_xml['kind']=='dir'){
            $this->type = (string)$file_xml['kind'];
        }else if($ext){
            $this->type=$ext;
        }else{
            $this->type='unknown';
        }
        if($file_xml->size){
            $this->size=(string)$file_xml->size;
        }
        $this->path = $root_path.'/'.$this->name;
        $this->versions=array();
    }

    /**
     * @param $log_entries -- An array of LogEntry
     * This function construct an array of all the previous versions for the file or subdirectory
     */
    public function find_all_revisions_for_files($log_entries){
//        echo "new".'<br>';
        foreach($log_entries as $rev_num=>$log_entry){
            if(in_array($this->name, $log_entry->files)){
//                echo $this->name.'<br>';
                $version = new Version($rev_num, $log_entry->author, $log_entry->msg, $log_entry->date);
                array_push($this->versions, $version);
            }
        }
    }
}


