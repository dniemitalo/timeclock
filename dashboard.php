<?php
session_start();
if(!isset($_SESSION['signed_in']) || !$_SESSION['signed_in']){
	$_SESSION['flash_error'] = "Please sign in";
    header("Location: https://just136.justhost.com/~nemosha1/timeclock/admin/login.php");
	die(); //stops the PHP script from running
}
?>
<html>
<head>
	<title>Dashboard</title>
	<meta name=viewport content="width=device-width">
	<link rel="stylesheet" type="text/css" href="timeclockadmin.css">
</head>
<body>
<h1 class="title">Dashboard</h1>
<div class="main">
<p>
<a href="https://just136.justhost.com/~nemosha1/timeclock/admin/logout.php">Log Out</a><br>
<a href="https://just136.justhost.com/~nemosha1/timeclock/admin/guardians.php">Guardians</a><br>
<a href="https://just136.justhost.com/~nemosha1/timeclock/admin/rosters2.php">Rosters</a><br>
<a href="https://just136.justhost.com/~nemosha1/timeclock/admin/rosters.php">Rosters with cell</a><br>
<a href="https://just136.justhost.com/~nemosha1/timeclock/admin/rosters_email.php">Emails</a><br>
<a href="https://just136.justhost.com/~nemosha1/timeclock/admin/parents.php">Parents</a><br>
<a href="https://just136.justhost.com/~nemosha1/timeclock/admin/paperwork.php">Update Paperwork</a><br>
<a href="https://just136.justhost.com/~nemosha1/timeclock/admin/safetytests.php">Update Safety Tests</a><br>
<a href="https://just136.justhost.com/~nemosha1/timeclock/admin/clocked_in.php">Clocked In Now</a><br>
</p>
<?php
	//ini_set('display_errors', 'On');
	//error_reporting(E_ALL | E_STRICT);
require_once '../db.php';
$teams = array("967","4150","4324","10107", "Mentors", NULL, "Inactive");
foreach ($teams as $team){
	$sql = "SELECT ID, first, last, CoC, FIRSTconsent, UofIconsent, team_pref, team FROM students WHERE team='$team' ORDER BY last, first";
	if ($team == NULL) {
		$team = "Unassigned";
		$sql = "SELECT ID, first, last, CoC, FIRSTconsent, UofIconsent, team_pref, team FROM students WHERE team = '' OR team IS NULL ORDER BY last, first";		
	}
	$result = mysqli_query($conn,$sql);
	$num_students = mysqli_num_rows($result);
	$form_fields = array('CoC','FIRSTconsent','UofIconsent');
	echo "<h4>Team $team (count = $num_students)</h4>\n";
	// echo "<table><tr><th class='left'>Name</th><th>CoC</th><th>FI</th><th>UI</th>";
	echo "<table><tr><th class='left'>Name</th>";
	echo "<th class='left'>Hours</th>";
	if ($team == "Unassigned"){echo "<th>Team Pref</th>";}
	echo "<th></th></tr>";
	while($row = mysqli_fetch_assoc($result)){
		echo "<tr>";
		echo "<form method='post' style='margin: 0; padding: 0;' action='https://just136.justhost.com/~nemosha1/timeclock/admin/update_team.php'>";
		echo "<td><a href='https://just136.justhost.com/~nemosha1/timeclock/admin/student.php?idfield={$row['ID']}'>{$row['last']}, {$row['first']}</a></td>\n";
		// foreach($form_fields as $field){
		// 	if ($row["$field"]=='Y') {$checked='checked';}
		// 	else {$checked='';}
		// 	$name = $field.'[]';
		// 	echo "\t<td><input type='checkbox' value='{$row['ID']}' name='$name' $checked></td>\n";
		// 	}
		if($team == "Unassigned") {echo "<td>{$row['team_pref']}</td>";}
		$pref = $row['team_pref'];
		$selected967 = '';
		$selected4150 = '';
		$selected4324 = '';
		$selected10107 = '';
		$selectedMentors = '';
		if($pref == '967') {$selected967 = "selected";}
		if($pref == '4150') {$selected4150 = "selected";}
		if($pref == '4324') {$selected4324 = "selected";}
		if($pref == '10107') {$selected10107 = "selected";}
		if($team == 'Mentors') {$selectedMentors = "selected";}
		echo "<td><a href='https://just136.justhost.com/~nemosha1/timeclock/admin/student_hours.php?idfield={$row['ID']}'>Hours</a></td>";
		echo "<td>";
		echo "<select id='team' name='team'>";
		echo "<option value=''>Unassigned</option>";
		echo "<option value='Inactive'>Inactive</option>";
		echo "<option value='967' $selected967>967 FRC</option>";
		echo "<option value='4150' $selected4150>4150 DM</option>";
		echo "<option value='4324' $selected4324>4324 LiT</option>";
		echo "<option value='10107' $selected10107>10107 ALoTO</option>";
		echo "<option value='Mentors' $selectedMentors>Mentor/Volunteer</option>";
		echo "</select></td>";
		echo "<td><input type='hidden' name='idfield' value='{$row['ID']}'>";
		echo "<input type='submit'></td>";
		echo "</form>";
		echo "</tr>";
		}
	echo "</table>";
	}
	mysqli_close($conn);
?>
</div>
</body>
</html>