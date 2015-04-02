<?php
/**
 * Created by PhpStorm.
 * User: calvinmwhu
 * Date: 4/1/15
 * Time: 1:22 AM
 */

include_once 'log_entry.php';
include_once 'project_entry.php';
include_once 'file_entry.php';


class Parser
{
    public $svn_list, $svn_log;
    public $project_lists;
    public $log_entries;
    public $root_path;

    function __construct()
    {
        clearstatcache();
        $root = $_SERVER['DOCUMENT_ROOT'];
        $list_path = $root . '/svn_list.xml';
        $log_path = $root . '/svn_log.xml';
        if (!file_exists($log_path) || !file_exists($list_path)) {
            echo "<h1 style=\"color:red\"> cannot find file </h1>";
            throw new Exception("cannot find resource files");
        } else {
            echo "<h1 style=\"color:blue\"> can find file </h1>";
            $this->svn_list = simplexml_load_file($list_path);
            $this->svn_log = simplexml_load_file($log_path);
            $count = $this->svn_list->children()->children()->count();
            echo "<h1 style=\"color:blue\"> $count </h1>";
        }
        $this->project_lists = array();
        $this->log_entries = array();
        $this->root_path = $this->svn_list->list['path'];
        $this->curr_project=null;
        $this->parse_log_entries();
        $this->parse_projects_and_files();
    }

    public function parse_log_entries()
    {
        foreach ($this->svn_log->children() as $logEntry_xml) {
//            echo "reach<br>";
            $logEntry = new LogEntry($logEntry_xml);
//            print_r($logEntry->revision);
            $this->log_entries[(string)$logEntry->revision] = $logEntry;

        }
    }

    public function parse_projects_and_files()
    {
        foreach ($this->svn_list->list->children() as $entry_xml) {
            if (!strstr($entry_xml->name, '/')) {
                //the file is a project folder
                $curr_project=new ProjectEntry($entry_xml);
                $this->project_lists[$curr_project->title]=$curr_project;
            }else{
                //the file is a file or dir
                $belong_project = explode($entry_xml, '/')[0];
                if(array_key_exists($belong_project, $this->project_lists)){
                    $curr_file = new FileEntry($entry_xml,$this->root_path);
//                    $this->project_lists[$belong_project]->add_file($curr_file);
                }
            }
        }
    }
}

$parser = new Parser;
echo count($parser->log_entries).'<br>';

//foreach($parser->log_entries as $key=>$value){
//    print_r($value);
//}

?>
