<?php
session_start();

if(!$_SESSION['signed_in']){
	die("You are not signed in.");
}
echo "Session file loaded<br>";
echo $_SESSION['username']."<br>";
?>