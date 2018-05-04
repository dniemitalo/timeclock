<?php
session_start();
if(!isset($_SESSION['signed_in']) || !$_SESSION['signed_in']){
	$_SESSION['flash_error'] = "Please sign in";
    header("Location: https://just164.justhost.com/~nemosha1/timeclock/admin/login.php");
	die(); //stops the PHP script from running
}
require_once '../db.php';
#retrieve existing password hash before replacing student record
$sql = "SELECT server_password FROM students WHERE ID='{$_POST['idfield']}'";
if($result = mysqli_query($conn, $sql)){
	$row = mysqli_fetch_assoc($result);
	$server_password = $row['server_password'];
}
else{
	//Quit if password hash not retrieved.
	echo mysqli_error($conn);
	die('Database error.');
}

$ID = trim(mysqli_real_escape_string($conn, $_POST['idfield']));
$last = trim(mysqli_real_escape_string($conn, $_POST['last']));
$first = trim(mysqli_real_escape_string($conn, $_POST['first']));
$email = trim(mysqli_real_escape_string($conn, $_POST['email']));
$cell = trim(mysqli_real_escape_string($conn, $_POST['cell']));
$gradclass = trim(mysqli_real_escape_string($conn, $_POST['gradclass']));
$shirtsize = trim(mysqli_real_escape_string($conn, $_POST['shirtsize']));
$server_login = trim(strtolower(mysqli_real_escape_string($conn, $_POST['server_login'])));
$server_password = trim(strtolower(mysqli_real_escape_string($conn, $_POST['server_password'])));
$guardian1first = trim(mysqli_real_escape_string($conn, $_POST['guardian1first']));
$guardian1last = trim(mysqli_real_escape_string($conn, $_POST['guardian1last']));
$guardian1email = trim(mysqli_real_escape_string($conn, $_POST['guardian1email']));
$guardian1cell = trim(mysqli_real_escape_string($conn, $_POST['guardian1cell']));
$guardian2first = trim(mysqli_real_escape_string($conn, $_POST['guardian2first']));
$guardian2last = trim(mysqli_real_escape_string($conn, $_POST['guardian2last']));
$guardian2email = trim(mysqli_real_escape_string($conn, $_POST['guardian2email']));
$guardian2cell = trim(mysqli_real_escape_string($conn, $_POST['guardian2cell']));
$activities = trim(mysqli_real_escape_string($conn, $_POST['activities']));
$availability = trim(mysqli_real_escape_string($conn, $_POST['availability']));
$bring = trim(mysqli_real_escape_string($conn, $_POST['bring']));
$role = trim(mysqli_real_escape_string($conn, $_POST['role']));
$comments = trim(mysqli_real_escape_string($conn, $_POST['comments']));
$prog_pref = trim(mysqli_real_escape_string($conn, $_POST['prog_pref']));
$team_pref = trim(mysqli_real_escape_string($conn, $_POST['team_pref']));
$team = trim(mysqli_real_escape_string($conn, $_POST['team']));

$sql = "REPLACE INTO students (ID, team, last,first,email,cell,gradclass,shirtsize,server_login,server_password,guardian1first,guardian1last,guardian1email,guardian1cell,guardian2first,guardian2last,guardian2email,guardian2cell,activities,availability,bring,role,comments, prog_pref,team_pref) VALUES ('$ID','$team','$last','$first','$email','$cell',$gradclass,'$shirtsize','$server_login','$server_password','$guardian1first','$guardian1last','$guardian1email','$guardian1cell','$guardian2first','$guardian2last','$guardian2email','$guardian2cell','$activities','$availability','$bring','$role','$comments','$prog_pref','$team_pref')";

if ($result = mysqli_query($conn,$sql)){
	echo "An application for $first $last has been successfully submitted.";
} else{
	echo mysqli_error($conn);
}

mysqli_close($conn);
header("Location: https://just164.justhost.com/~nemosha1/timeclock/admin/rosters.php");
?>
