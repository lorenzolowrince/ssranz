<?php

$localhost = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "ssranz"; 

// Create connection
$conn = mysqli_connect($localhost, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>