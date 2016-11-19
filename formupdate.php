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
	echo $id_list['$field']."<br>";
	}

$sql = "";
$conn->close();
?>
</div>
</body>
</html>
