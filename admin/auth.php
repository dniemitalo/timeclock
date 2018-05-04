<?php
require_once '../db.php';

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT username, password FROM users WHERE username='$username'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

session_start();
session_destroy();
session_start();
if ($row){
	if (password_verify($password, $row['password'])){
		$_SESSION['signed_in'] = true;
		$_SESSION['username'] = $username;
		// echo "Welcome, $username.";
		header('Location: https://just164.justhost.com/~nemosha1/timeclock/admin/dashboard.php');
	} else {
		//case if row exists but password doesn't match stored hash
		$_SESSION['flash_error'] = "Invalid username or Password.";
		$_SESSION['signed_in'] = false;
		$_SESSION['username'] = null;
		// echo "Invalid username or Password.";
		header('Location: https://just164.justhost.com/~nemosha1/timeclock/admin/login.php');
		//header
	}
} else {
	// Invalid username or password
	$_SESSION['flash_error'] = "Invalid Username or password.";
	$_SESSION['signed_in'] = false;
	$_SESSION['username'] = null;
	header('Location: https://just164.justhost.com/~nemosha1/timeclock/admin/login.php');
	// echo "Invalid Username or password.";
	//header
}
mysqli_close($conn);

?>