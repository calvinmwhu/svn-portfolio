<?php
/**
 * Created by PhpStorm.
 * User: calvinmwhu
 * Date: 4/5/15
 * Time: 11:55 PM
 */


require_once 'config.php';


class Comments
{
    public $comments = array();

    function __construct()
    {
        $conn = new mysqli($config['db']['db_localhost']['hostname'], $config['db']['db_localhost']['username'], $config['db']['db_localhost']['password'], $config['db']['db_localhost']['database']);
        //$conn = new mysqli($config['db']['db_mhu9']['hostname'], $config['db']['db_mhu9']['username'], $config['db']['db_mhu9']['password'],$config['db']['db_mhu9']['database']);
        if ($conn->connect_error) die($conn->connect_error);

    }

}