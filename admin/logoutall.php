<?php
session_start();
if(!isset($_SESSION['signed_in']) || !$_SESSION['signed_in']){
	$_SESSION['flash_error'] = "Please sign in";
    header("Location: https://just164.justhost.com/~nemosha1/timeclock/admin/login.php");
	die(); //stops the PHP script from running
}
require_once '../db.php';
$sql = "update students set punched_in = 0";
mysqli_query($conn, $sql);
mysqli_close($conn);
header("Location: https://just164.justhost.com/~nemosha1/timeclock/admin");
?>