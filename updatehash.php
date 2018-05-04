<?php
require_once 'db.php';
$sql = "SELECT ID, server_password FROM students";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)){
	$studentid = $row['ID'];
	$password = strtolower($row['server_password']);
	$hash = password_hash($password, PASSWORD_DEFAULT);
	$sql = "UPDATE students SET server_password = '$hash' WHERE ID = {$studentid}";
	if(mysqli_query($conn, $sql)){
		echo "Updated student $studentid<br>";
	} else {
		echo "Query failed $studentid<br>";
	}
}
echo "Finished.";
mysqli_close($conn);
?>