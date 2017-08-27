<!DOCTYPE html>
<html>
<head>
	<meta name=viewport content="width=device-width">
	<link rel="stylesheet" type="text/css" href="timeclock.css">
</head>
<body>
<h1 class="title"><a class="clickable" href="http://www.nemoquiz.com/timeclock">Robotics Time Clock</a></h1>
<div class="main">
<p>FRC Hours Since Kickoff:<p>
<?php
require_once 'db.php';
$teams = array("967");
foreach ($teams as $team){
	$sql = "SELECT team, last, first, SUM(hours) as sum FROM hours JOIN students ON hours.ID = students.ID WHERE students.team = '$team' AND hours.date >= '2018-01-05' GROUP BY hours.ID ORDER BY sum DESC";
	if ($result = mysqli_query($conn,$sql)){
		echo "<p><strong>Team $team</strong></p>";
		?>
			<table><tr>
			<td><strong>Last</strong></td>
			<td><strong>First</strong></td>
			<td><strong>Hours</strong></td></tr>
		<?php
		$team_hours = 0;
		while($row = mysqli_fetch_assoc($result)) 
			{
			echo "<tr>";
			echo "<td>".$row['last']."</td>";
			echo "<td>".$row['first']."</td>";
			echo "<td>".round($row['sum'],1)."</td>";
			echo "</tr>\n";
			$team_hours += $row['sum'];
			}
		echo "</table>";
		$team_hours = round($team_hours,1);
		echo "<p>Total Team $team hours: $team_hours</p>";
		}
	else{echo mysqli_error($conn);}
}
mysqli_close($conn);
?>
</div>
<div class="divbutton">
	<a class="clickable" href="http://www.nemoquiz.com/timeclock">Go Back</a>
</div>
</body>
</html>