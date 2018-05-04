<?php
session_start();
if(!isset($_SESSION['signed_in']) || !$_SESSION['signed_in']){
	$_SESSION['flash_error'] = "Please sign in";
    header("Location: https://just164.justhost.com/~nemosha1/timeclock/admin/login.php");
	die(); //stops the PHP script from running
}
// echo "Welcome to admin dashboard.";
?>
<html>
<head>
	<title>Dashboard</title>
	<meta name=viewport content="width=device-width">
	<link rel="stylesheet" type="text/css" href="timeclockadmin.css">
</head>
<body>
<h1 class="title">Update Forms</h1>
<div class="main">
<p>
<a href="https://just164.justhost.com/~nemosha1/timeclock/admin/logout.php">Log Out</a><br>
<a href="https://just164.justhost.com/~nemosha1/timeclock/admin/dashboard.php">Back to Dashboard</a><br>
</p>
<?php
require_once '../db.php';
$teams = array(NULL, "967","4150","4324","10107", "Mentors");
foreach ($teams as $team){
	$sql = "SELECT ID, first, last, CoC, FIRSTconsent, UofIconsent, team_pref FROM students WHERE team='$team' ORDER BY last, first";
	if ($team == NULL) {
		$team = "Unassigned";
		$sql = "SELECT ID, first, last, CoC, FIRSTconsent, UofIconsent, team_pref FROM students WHERE team = '' OR team IS NULL ORDER BY last, first";		
	}
	echo "<h4 class='center'>Team $team</h4>\n";
	echo "<table><tr><th class='left'>Name</th><th>CoC</th><th>FI</th><th>UI</th>\n";
	echo "<th></th></tr>";
	$result = mysqli_query($conn,$sql);
	$form_fields = array('CoC','FIRSTconsent','UofIconsent');
	while($row = mysqli_fetch_assoc($result)){
		echo "<tr>";
		echo "<form method='post' style='margin: 0; padding: 0;' action='https://just164.justhost.com/~nemosha1/timeclock/admin/update_paperwork.php'>";
		echo "<td><a href='https://just164.justhost.com/~nemosha1/timeclock/admin/student.php?idfield={$row['ID']}'>{$row['last']}, {$row['first']}</a></td>\n";
		foreach($form_fields as $field){
			if ($row["$field"]=='Y') {$checked='checked';}
			else {$checked='';}
			$name = $field.'[]';
			echo "\t<td><input type='checkbox' value='Yes' name='$field' $checked></td>\n";
			}
		echo "<td><input type='number' name='idfield' value={$row['ID']}><input type='submit'></td>";
		echo "</form>";
		echo "</tr>\n";
		}
	echo "</table>";
	}
	mysqli_close($conn);
?>
</div>
</body>
</html>