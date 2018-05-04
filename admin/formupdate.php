<?php
session_start();
if(!isset($_SESSION['signed_in']) || !$_SESSION['signed_in']){
	$_SESSION['flash_error'] = "Please sign in";
    header("Location: https://just164.justhost.com/~nemosha1/timeclock/admin");
	die();
}
require_once '../db.php';
$form_fields = array('CoC','FIRSTconsent','UofIconsent');
$id_lists = array();
foreach($form_fields as $field){
	$id_list['$field'] = "";
	foreach ($_POST[$field] as $id){
		if ($id === end($_POST[$field])){$id_list['$field'] .= $id;}
		else {$id_list['$field'] .= "$id,";}
		}
	$sql = "UPDATE students SET $field='Y' WHERE id IN ({$id_list['$field']})";
	mysqli_query($conn,$sql);
	}
$conn->close();
header("Location: https://just164.justhost.com/~nemosha1/timeclock/admin");
?>