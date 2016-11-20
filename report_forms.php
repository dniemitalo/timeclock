<!DOCTYPE html>
<html>
<head>
	<meta name=viewport content="width=device-width">
	<link rel="stylesheet" type="text/css" href="timeclock.css">
</head>
<body>
<h1 class="title"><a class="clickable" href="http://www.nemoquiz.com/timeclock">Robotics Time Clock</a></h1>
<div class="main">
	<p>CoC = <a target="_blank" href="http://lmrobotics.com/wp-content/uploads/2016/10/LMR_Code_of_Conduct.pdf">Code of Conduct</a><br>
		FI = <a target="_blank" href="http://lmrobotics.com/wp-content/uploads/2015/09/first-youth-team-member-paperwork-2016-2017.pdf">FIRST Consent Form</a><br>
		UI = <a target="_blank" href="http://lmrobotics.com/wp-content/uploads/2015/09/UI_Consent_form.pdf">U of Iowa Consent Form</a><br>
		<br>
		Consent form info: <a target="_blank" href="http://www.lmrobotics.com/consent">lmrobotics.com/consent</a>
		Online FIRST Consent Form: <a target="_blank" href="https://my.usfirst.org/stims/Login.aspx">STIMS</a></br>
	</p>

<form action='formupdate.php' method='post'>
<?php
	//ini_set('display_errors', 'On');
	//error_reporting(E_ALL | E_STRICT);
	require_once 'db.php';
$teams = array("967","4150","4324","10107");
foreach ($teams as $team){
	echo "<h4 class='center'>Team $team</h4>\n";
	echo "<table><tr><th class='left'>Name</th><th>CoC</th><th>FI</th>";
	if ($team != "967"){echo "<th>UI</th>";}
	echo "</tr>";
	$sql = "SELECT id, first, last, CoC, FIRSTconsent, UofIconsent FROM students WHERE team='$team' ORDER BY last, first";
	$result = mysqli_query($conn,$sql);
	$form_fields = array('CoC','FIRSTconsent','UofIconsent');
	if ($team == "967"){$form_fields = array('CoC','FIRSTconsent');}
	while($row = mysqli_fetch_assoc($result)){
		echo "<tr><td>$row[last], $row[first]</td>\n";
		foreach($form_fields as $field){
			if ($row["$field"]=='Y') {$checked='checked';}
			else {$checked='';}
			$name = $field.'[]';
			echo "\t<td><input type='checkbox' disabled='disabled' value='{$row['id']}' name='$name' $checked></td>\n";
			}
		echo "</tr>\n";
		}
	echo "</table>";
	}
?>
</form>
</div>
</body>
</html>