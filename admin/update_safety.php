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
//'hand_drill_belt_sander','saws','drill_press','grinder','lathe_mill'
if($_POST['hand_drill_belt_sander'] == 'Yes') {$hand_drill_belt_sander = "Y";} else {$hand_drill_belt_sander = NULL;}
if($_POST['saws'] == 'Yes') {$saws = "Y";} else {$saws = NULL;}
if($_POST['drill_press'] == 'Yes') {$drill_press = "Y";} else {$drill_press = NULL;}
if($_POST['grinder'] == 'Yes') {$grinder = "Y";} else {$grinder = NULL;}
if($_POST['lathe_mill'] == 'Yes') {$lathe_mill = "Y";} else {$lathe_mill = NULL;}
$sql = "UPDATE students SET hand_drill_belt_sander='$hand_drill_belt_sander', saws='$saws', drill_press='$drill_press', grinder='$grinder', lathe_mill='$lathe_mill' WHERE ID='$idfield'";
// echo $sql;
if (mysqli_query($conn, $sql)){
	echo "Success";
} else {
	echo mysqli_error($conn);
}
mysqli_close($conn);

header('Location: https://just164.justhost.com/~nemosha1/timeclock/admin/safetytests.php');
?>