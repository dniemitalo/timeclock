<?php
session_start();
if(!isset($_SESSION['signed_in']) || !$_SESSION['signed_in']){
	$_SESSION['flash_error'] = "Please sign in";
    header("Location: https://just164.justhost.com/~nemosha1/timeclock/admin/login.php");
	die(); //stops the PHP script from running
}
require_once '../db.php';
//db query
$sql = "SELECT first, last, email, team, cell, guardian1first, guardian1last, guardian1cell, guardian1email, guardian2first, guardian2last, guardian2cell, guardian2email FROM students ORDER BY CASE team WHEN '967' THEN 1 WHEN '4150' THEN 2 WHEN '4324' THEN 3 WHEN '10107' THEN 4 END, last, first";
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
<h1 class="title">Guardians</h1>
<div class="main">
<p><a href="https://just164.justhost.com/~nemosha1/timeclock/admin/dashboard.php">Back to Dashboard</a></p>
<p><a href="https://just164.justhost.com/~nemosha1/timeclock/admin/logout.php">Log Out</a><br></p>
</table>
<p><strong>Guardians</strong></p>
<table>
<tr><th>Team</th><th>Last</th><th>First</th><th>email</th><th>cell</th></tr>
<?php 
while ($row = mysqli_fetch_assoc($result)){
	if($row['guardian1first'] != "" && $row['guardian2first'] != NULL){
		echo "<tr>";
		echo "<td>{$row['team']}</td>";
		echo "<td>{$row['guardian1first']}</td>";
		echo "<td>{$row['guardian1last']}</td>";
		echo "<td>{$row['guardian1email']}</td>";
		echo "<td>{$row['guardian1cell']}</td>";
		echo "</tr>";
	}
	if($row['guardian2first'] != "" && $row['guardian2first'] != NULL){
		echo "<tr>";
		echo "<td>{$row['team']}</td>";
		echo "<td>{$row['guardian2first']}</td>";
		echo "<td>{$row['guardian2last']}</td>";
		echo "<td>{$row['guardian2email']}</td>";
		echo "<td>{$row['guardian2cell']}</td>";
		echo "</tr>";
	}
}
?>
</table>

</div>
</body>
</html>