<?php 
error_reporting(E_ALL);
$username = 'nemosha1_tcadmin'; 
$password = 'cleverpassword12345'; 
//password was changed after I created this public repository.
$host = 'localhost'; 
$dbname = 'nemosha1_timeclock'; 
$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);} 
?>