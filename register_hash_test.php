<?php
require_once 'db.php';
$username = $_GET['username'];
$hash = password_hash($_GET['password'], PASSWORD_DEFAULT);
$sql = "INSERT INTO users (username, password) VALUES ('$username', '$hash')";
if ( mysqli_query($conn, $sql) ) {
	echo "Success";
} else {
	echo "Failure";
}

mysqli_close($conn);
?>