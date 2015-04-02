<?php
/**
 * Created by PhpStorm.
 * User: calvinmwhu
 * Date: 4/1/15
 * Time: 12:14 AM
 */

class FileEntry {
    public $size=0, $type, $path, $versions;
    public $name;
    function __construct($file_xml, $root_path){
        $this->name = (string)$file_xml->name;
        $ext = pathinfo($this->name, PATHINFO_EXTENSION);
        if($file_xml['kind']=='dir'){
            $this->type = (string)$file_xml['kind'];
        }else{
            $this->type=$ext;
        }
        if($file_xml->size){
            $this->size=(string)$file_xml->size;
        }
        $this->path = $root_path.'/'.$this->name;
    }
}


?>