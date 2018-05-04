<?php
session_start();
if(!isset($_SESSION['signed_in']) || !$_SESSION['signed_in']){
	$_SESSION['flash_error'] = "Please sign in";
    header("Location: https://just164.justhost.com/~nemosha1/timeclock/admin/login.php");
	die(); //stops the PHP script from running
}
require_once '../db.php';
//db query
$sql = "SELECT ID, first, last, email, team, cell, gradclass, role, guardian1first, guardian1last, guardian1cell, guardian1email, guardian2first, guardian2last, guardian2cell, guardian2email FROM students ORDER BY CASE team WHEN '967' THEN 1 WHEN '4150' THEN 2 WHEN '4324' THEN 3 WHEN '10107' THEN 4 WHEN 'Mentors' THEN 5 END, last, first";
$result = mysqli_query($conn, $sql);
mysqli_close($conn);
?>
<html>
<head>
	<title>Dashboard</title>
	<meta name=viewport content="width=device-width">
	<link rel="stylesheet" type="text/css" href="timeclockadmin.css">
	<style>
		th {text-align: left;}
	</style>
</head>
<body>
<h1 class="title">Team Rosters</h1>
<div class="main">
	<a href="https://just164.justhost.com/~nemosha1/timeclock/admin/logout.php">Log Out</a><br>
</table>
<table>
<p><a href="https://just164.justhost.com/~nemosha1/timeclock/admin/dashboard.php">Back to Dashboard</a></p>
<tr><th>Team</th><th>Student</th><th>Grade</th><th>Roles</th></tr>
<?php 
$year = date('Y');
$year = (int)$year;
$month = date('m');
$month = (int)$month;
if($month > 7){
	$year = $year + 1;
}
while ($row = mysqli_fetch_assoc($result)){
	$grade = 12 + $year - $row['gradclass'];
	echo "<tr>";
	echo "<td>{$row['team']}</td>";
	echo "<td><a href='https://just164.justhost.com/~nemosha1/timeclock/admin/student.php?idfield={$row['ID']}'>{$row['last']}, {$row['first']}</a></td>";
	echo "<td>$grade</td>";
	echo "<td>{$row['role']}</td>";
	echo "</tr>";
}
?>
</table>

</div>
</body>
</html>