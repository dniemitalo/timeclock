<!DOCTYPE html>
<?php
require_once 'db.php';
?>
<html>
<head>
</head>
<body>
<h1>Robotics Time Clock</h1>
<table>
<tr><td><strong>Last</strong></td><td><strong>First</strong></td><td><strong>Hours</strong></td></tr>
<?php
$sql = "SELECT last, first, SUM(hours) as sum FROM hours JOIN students ON hours.ID = students.ID GROUP BY hours.ID ORDER BY students.last";
if ($result = mysqli_query($conn,$sql)){
		while($row = mysqli_fetch_assoc($result)) 
			{
			echo "<tr><td>".$row['last']."</td>";
			echo "<td>".$row['first']."</td>";
			echo "<td>".round($row['sum'],2)."</td></tr>\n";
			}
	}
else{
		echo mysqli_error($conn);
	}
?>
</table>
<p><a href="http://www.nemoquiz.com/timeclock">Return to Time Clock</a></p>
</body>
</html>

<?php
$conn->close();
?>