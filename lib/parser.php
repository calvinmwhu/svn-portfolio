<?php
/**
 * Created by PhpStorm.
 * User: calvinmwhu
 * Date: 4/1/15
 * Time: 1:22 AM
 */

class Parser {
    public $svn_list, $svn_log;
    public $project_lists;

    function __construct(){
        if(!file_exists('svn_list.xml') || !file_exists('svn_log.xml')){
            echo "cannot find file";
//            throw new Exception("cannot find resource files");

        }else{
            echo "can find file";
//            $this->svn_list = simplexml_load_file('svn_list.xml');
//            $this->svn_log = simplexml_load_file('svn_log.xml');
        }
        $this->project_lists=array();
    }

}

$parser=  new Parser;

?>
