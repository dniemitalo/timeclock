<?php
require_once 'db.php';

$ID = $_POST['idfield'];
$last = $_POST['last'];
$first = $_POST['first'];
$email = $_POST['email'];
$cell = $_POST['cell'];
$gradclass = $_POST['gradclass'];
$shirtsize = $_POST['shirtsize'];
$server_login = $_POST['server_login'];
$server_password = $_POST['server_password'];
$guardian1first = $_POST['guardian1first'];
$guardian1last = $_POST['guardian1last'];
$guardian1email = $_POST['guardian1email'];
$guardian1cell = $_POST['guardian1cell'];
$guardian2first = $_POST['guardian2first'];
$guardian2last = $_POST['guardian2last'];
$guardian2email = $_POST['guardian2email'];
$guardian2cell = $_POST['guardian2cell'];
$activities = $_POST['activities'];
$availability = $_POST['availability'];
$bring = $_POST['bring'];
$role = $_POST['role'];
$prog_pref = $_POST['prog_pref'];
$team_pref = $_POST['team_pref'];

$sql = "INSERT INTO students (ID,last,first,email,cell,gradclass,shirtsize,server_login,server_password,guardian1first,guardian1last,guardian1email,guardian1cell,guardian2first,guardian2last,guardian2email,guardian2cell,activities,availability,bring,role,prog_pref,team_pref) VALUES ('$ID','$last','$first','$email','$cell',$gradclass,'$shirtsize','$server_login','$server_password','$guardian1first','$guardian1last','$guardian1email','$guardian1cell','$guardian2first','$guardian2last','$guardian2email','$guardian2cell','$activities','$availability','$bring','$role','$prog_pref','$team_pref')";

if ($result = mysqli_query($conn,$sql)){
	echo "An application for $first $last has been successfully submitted.";
} else{
	echo mysqli_error($conn);
}

$conn->close();

?>
