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
	<p>Hours in the last 30 days:<p>

<?php
//$sql = "SELECT team, last, first, SUM(hours) as sum FROM hours JOIN students ON hours.ID = students.ID WHERE students.team IN ('967','4150','4324','10107') GROUP BY hours.ID ORDER BY FIELD(students.team,'967','4150','4324','10107'), sum DESC";
$teams = array("967","4150","4324","10107");
foreach ($teams as $team){
	//$sql = "SELECT team, last, first, SUM(hours) as sum FROM hours JOIN students ON hours.ID = students.ID WHERE students.team = '$team' GROUP BY hours.ID ORDER BY sum DESC";
	$sql = "SELECT team, last, first, SUM(hours) as sum FROM hours JOIN students ON hours.ID = students.ID WHERE students.team = '$team' AND hours.date > NOW() - INTERVAL 30 DAY GROUP BY hours.ID ORDER BY sum DESC";
	if ($result = mysqli_query($conn,$sql)){
			echo "<p><strong>Team $team</strong></p>";
			echo "<table><tr><td><strong>Last</strong></td><td><strong>First</strong></td><td><strong>Hours</strong></td></tr>";
			$team_hours = 0;
			while($row = mysqli_fetch_assoc($result)) 
				{
				//echo "<tr><td>".$row['team']."</td>";
				echo "<tr><td>".$row['last']."</td>";
				echo "<td>".$row['first']."</td>";
				echo "<td>".round($row['sum'],1)."</td></tr>\n";
				$team_hours += $row['sum'];
				}
			echo "</table>";
			$team_hours = round($team_hours,1);
			echo "<p>Total Team $team hours: $team_hours</p>";
		}
	else{
			echo mysqli_error($conn);
		}
}

?>

</div>
<div class="divbutton">
	<a class="clickable" href="http://www.nemoquiz.com/timeclock">Go Back</a>
</div>
</body>
</html>
<?php
$conn->close();
?>