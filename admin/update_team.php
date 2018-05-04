<?php
session_start();
if(!isset($_SESSION['signed_in']) || !$_SESSION['signed_in']){
	$_SESSION['flash_error'] = "Please sign in";
    header("Location: https://just164.justhost.com/~nemosha1/timeclock/admin/login.php");
	die(); //stops the PHP script from running
}
if( !isset($_POST['idfield']) || !isset($_POST['team']) ) {
	header("Location: https://just164.justhost.com/~nemosha1/timeclock/admin");
	die();
}
$idfield = $_POST['idfield'];
$team = $_POST['team'];
require_once '../db.php';
$sql = "UPDATE students SET team='$team' WHERE ID=$idfield";
mysqli_query($conn, $sql);
mysqli_close($conn);
header('Location: https://just164.justhost.com/~nemosha1/timeclock/admin/dashboard.php');
?>