<!DOCTYPE html>
<?php
require_once 'db.php';
?>
<html>
<head>
	<meta name=viewport content="width=device-width">
	<link rel="stylesheet" type="text/css" href="timeclock.css">
</head>
<body>
<div class="title"><h1>Robotics Time Clock</h1></div>
<div class="main">
<?php
//ini_set('display_errors', 'On');
//error_reporting(E_ALL | E_STRICT);
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
?>
<p>Data has been updated. Maybe.</p>
</div>
<div class="divbutton">
	<a class="clickable" href="http://www.nemoquiz.com/timeclock">Go Back</a>
</div>
</body>
</html>