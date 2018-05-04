<?php
session_start();
if(!isset($_SESSION['signed_in']) || !$_SESSION['signed_in']){
	$_SESSION['flash_error'] = "Please sign in";
    header("Location: https://just164.justhost.com/~nemosha1/timeclock/admin/login.php");
	die(); //stops the PHP script from running
}
if(!isset( $_GET['idfield']) ){
	header("Location: https://just164.justhost.com/~nemosha1/timeclock/admin");
	die();
}
?>
<!doctype html>
<html>
<head>
	<meta name=viewport content="width=device-width">
	<link rel="stylesheet" type="text/css" href="timeclockadmin.css">
	<style type="text/css">
		textarea {
			width: 100%;
		}
	</style>
</head>
<body>
<div class="main">
<?php
$idfield = $_GET['idfield'];
require_once '../db.php';

$sql = "SELECT first, last, hours, date FROM hours JOIN students ON hours.ID=students.ID WHERE students.ID=$idfield AND date > '2017-08-20 12:00:00' ORDER BY date DESC";
// $sql = "SELECT * FROM hours WHERE ID=$idfield";
$result = mysqli_query($conn, $sql);
?>
<table>
<tr><th>First</th><th>Last</th><th>Date</th><th>Hours</th></tr>
<?php
while($row = mysqli_fetch_assoc($result)){
	$date_text = date('l, n/d/y', strtotime($row['date']) );
	echo "<tr>";
	echo "<td>{$row['first']}</td>";
	echo "<td>{$row['last']}</td>";
	echo "<td>$date_text</td>";
	echo "<td>{$row['hours']}</td>";
	echo "</tr>";
}
mysqli_close($conn);
?>
</table>	
</div>
</body>
</html>