<?php
session_start();
if(!isset($_SESSION['signed_in']) || !$_SESSION['signed_in']){
	$_SESSION['flash_error'] = "Please sign in";
    header("Location: https://just164.justhost.com/~nemosha1/timeclock/admin/login.php");
	die(); //stops the PHP script from running
}
if( !isset($_POST['idfield']) ) {
	echo "CoC: ".$_POST['CoC']."<br>";
	die('idfield not set.');
	header("Location: https://just164.justhost.com/~nemosha1/timeclock/admin");
}
$idfield = $_POST['idfield'];
require_once '../db.php';
if($_POST['CoC'] == 'Yes') {$CoC = "Y";} else {$CoC = NULL;}
if($_POST['FIRSTconsent'] == 'Yes') {$FIRSTconsent = "Y";} else {$FIRSTconsent = NULL;}
if($_POST['UofIconsent'] == 'Yes') {$UofIconsent = "Y";} else {$UofIconsent = NULL;}
$sql = "UPDATE students SET FIRSTconsent='$FIRSTconsent', UofIconsent='$UofIconsent', CoC='$CoC' WHERE ID='$idfield'";
// echo $sql;
if (mysqli_query($conn, $sql)){
	echo "Success";
} else {
	echo mysqli_error($conn);
}
mysqli_close($conn);

header('Location: https://just164.justhost.com/~nemosha1/timeclock/admin/paperwork.php');
?>