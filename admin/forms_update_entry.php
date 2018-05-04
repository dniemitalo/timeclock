<!DOCTYPE html>
<html>
<head>
	<meta name=viewport content="width=device-width">
	<link rel="stylesheet" type="text/css" href="../timeclock.css">
</head>
<body>
<h1 class="title">Update Forms</h1>
<div class="main">
<form action='formupdate.php' method='post'>
<?php
if ($_POST['password'] == 'wegotpickedby2056once'){
	echo "Welcome";
}
else {
	die('Username and password not recognized.');
}
	//ini_set('display_errors', 'On');
	//error_reporting(E_ALL | E_STRICT);
require_once '../db.php';
$teams = array("967","4150","4324","10107");
foreach ($teams as $team){
	echo "<h4 class='center'>Team $team</h4>\n";
	echo "<table><tr><th class='left'>Name</th><th>CoC</th><th>FI</th><th>UI</th></tr>";
	$sql = "SELECT id, first, last, CoC, FIRSTconsent, UofIconsent FROM students WHERE team='$team' ORDER BY last, first";
	$result = mysqli_query($conn,$sql);
	$form_fields = array('CoC','FIRSTconsent','UofIconsent');
	while($row = mysqli_fetch_assoc($result)){
		echo "<tr><td>$row[last], $row[first]</td>\n";
		foreach($form_fields as $field){
			if ($row["$field"]=='Y') {$checked='checked';}
			else {$checked='';}
			$name = $field.'[]';
			echo "\t<td><input type='checkbox' value='{$row['id']}' name='$name' $checked></td>\n";
			}
		echo "</tr>\n";
		}
	echo "</table>";
	}
?>
<tr><td><input type="submit"></td></tr>
</form>
</div>
</body>
</html>