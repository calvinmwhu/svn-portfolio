<?php
/**
 * Created by PhpStorm.
 * User: calvinmwhu
 * Date: 3/28/15
 * Time: 1:19 PM
 */

$servername = "localhost";
$username = "newuser";
$password = "newuser";


// Create connection
$conn = new mysqli($servername, $username, $password);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "CREATE DATABASE test";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully";
} else {
    echo "Error creating database: " . $conn->error;
}

$conn->close();

?>