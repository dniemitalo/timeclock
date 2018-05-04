<?php
if (! isset($_SERVER['HTTPS']) or $_SERVER['HTTPS'] == 'off' ) {
    header('Location: https://just136.justhost.com/~nemosha1/timeclock/register2.php');
    exit();
}
require_once 'db.php';
$ID = filter_var($_POST['idfield'],FILTER_SANITIZE_NUMBER_INT);
// $ID = trim(mysqli_real_escape_string($conn, $_POST['idfield']));
$last = trim(mysqli_real_escape_string($conn, $_POST['last']));
$first = trim(mysqli_real_escape_string($conn, $_POST['first']));
$email = trim(mysqli_real_escape_string($conn, $_POST['email']));
$cell = trim(mysqli_real_escape_string($conn, $_POST['cell']));
$gradclass = trim(mysqli_real_escape_string($conn, $_POST['gradclass']));
$shirtsize = trim(mysqli_real_escape_string($conn, $_POST['shirtsize']));
$server_login = trim(strtolower(mysqli_real_escape_string($conn, $_POST['server_login'])));
$server_password = trim(strtolower(mysqli_real_escape_string($conn, $_POST['server_password'])));
$server_password = password_hash($server_password, PASSWORD_DEFAULT);
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
$prog_pref = trim(mysqli_real_escape_string($conn, $_POST['prog_pref']));
$team_pref = trim(mysqli_real_escape_string($conn, $_POST['team_pref']));

$sql = "INSERT INTO students (ID,last,first,email,cell,gradclass,shirtsize,server_login,server_password,guardian1first,guardian1last,guardian1email,guardian1cell,guardian2first,guardian2last,guardian2email,guardian2cell,activities,availability,bring,role,prog_pref,team_pref) VALUES ('$ID','$last','$first','$email','$cell',$gradclass,'$shirtsize','$server_login','$server_password','$guardian1first','$guardian1last','$guardian1email','$guardian1cell','$guardian2first','$guardian2last','$guardian2email','$guardian2cell','$activities','$availability','$bring','$role','$prog_pref','$team_pref')";

if ($result = mysqli_query($conn,$sql)){
	echo "An application for $first $last has been successfully submitted.";
} else{
	echo mysqli_error($conn);
}

mysqli_close($conn);

?>
