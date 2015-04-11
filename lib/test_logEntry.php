<?php
/**
 * Created by PhpStorm.
 * User: calvinmwhu
 * Date: 4/11/15
 * Time: 1:30 AM
 */

require 'log_entry.php';

class LogEntryTest extends PHPUnit_Framework_TestCase{
    public function testConstructor(){
        $svn_log = simplexml_load_file('svn_log.xml');
        $log_xml = $svn_log->logentry[1];
        $entry = new LogEntry($log_xml);
        $this->assertEquals($entry->revision, '5083');
        $this->assertEquals($entry->author, 'mhu9');
        $this->assertEquals($entry->msg, 'Deleting');

    }

}
