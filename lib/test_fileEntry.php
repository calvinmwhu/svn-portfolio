<?php
/**
 * Created by PhpStorm.
 * User: calvinmwhu
 * Date: 4/11/15
 * Time: 1:30 AM
 */

require 'file_entry.php';

class FileEntryTest extends PHPUnit_Framework_TestCase{
    public function testConstructor(){
        $svn_list = simplexml_load_file('svn_list.xml');
        $file_entry = $svn_list->list->entry[0];
        $root_path = $svn_list->list['path'];
        $entry =new  FileEntry($file_entry, $root_path);
        $this->assertEquals($entry->name, 'assignment0');
        $this->assertEquals($entry->size, 0);
        $this->assertEquals($entry->type, 'dir');
    }

}
