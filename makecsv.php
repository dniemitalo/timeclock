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
<h1 class="title">Robotics Time Clock</h1>
<div class="main">
<table>
<tr><td><strong>ID</strong></td><td><strong>Last</strong></td><td><strong>First</strong></td><td><strong>Hours</strong></td><td><strong>CoC</strong></td></tr>
<?php
$sql = "SELECT students.id as id, last, first, CoC, SUM(hours) as sum FROM hours JOIN students ON hours.ID = students.ID GROUP BY hours.ID ORDER BY students.last";
if ($result = mysqli_query($conn,$sql)){
		while($row = mysqli_fetch_assoc($result)) 
			{
			echo "<tr><td>".$row['id']."</td>";
			echo "<td>".$row['last']."</td>";
			echo "<td>".$row['first']."</td>";
			echo "<td>".round($row['sum'],1)."</td>";
			echo "<td>".$row['CoC']."</td></tr>\n";
			}
	}
else{
		echo mysqli_error($conn);
	}
?>
</table>
</div>
<div class="divbutton">
	<a class="clickable" href="http://www.nemoquiz.com/timeclock">Go Back</a>
</div>
</body>
</html>
<?php
$conn->close();
?>