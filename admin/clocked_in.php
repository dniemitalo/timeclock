<?php
session_start();
if(!isset($_SESSION['signed_in']) || !$_SESSION['signed_in']){
	$_SESSION['flash_error'] = "Please sign in";
    header("Location: https://just164.justhost.com/~nemosha1/timeclock/admin/login.php");
	die(); //stops the PHP script from running
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta name=viewport content="width=device-width">
	<link rel="stylesheet" type="text/css" href="timeclockadmin.css">
	<style type="text/css">
		td {
			padding-right: 18px;
		}
	</style>
</head>
<body>
<div class="main">
<p><a href="https://just164.justhost.com/~nemosha1/timeclock/admin/logout.php">Log Out</a></p>
<p><a href="https://just164.justhost.com/~nemosha1/timeclock/admin/dashboard.php">Back to Dashboard</a></p>
<?php
require_once '../db.php';

//TO DO: check if any students are clocked in with most recent punch prior to today's date
//If so, query for a list of those students and clock them all out.

$teams = array("967","4150","4324","10107", "Mentors");
$LMR_total = 0;
foreach ($teams as $team){
	$team_total=0;
	$sql = "select first, last, team, punched_in, MAX(time) as t FROM punches JOIN students ON punches.ID = students.ID WHERE punched_in = 1 and team='$team' GROUP BY punches.ID ORDER BY team, t;";
	if ($result = mysqli_query($conn,$sql)){
		echo "<p><strong>Team $team</strong></p>";
		echo "<table>";
		while($row = mysqli_fetch_assoc($result)) 
			{
				$team_total += 1;
				$date = date_create($row['t']);
				$t = date_format($date, 'D n-d, g:i A');	
				echo "<tr>";
				echo "<td>".$row['last']."</td>";
				echo "<td>".$row['first']."</td>";
				echo "<td>".$t."</td>";
				echo "</tr>\n";
			}
		echo "<tr><td>Total:</td><td>$team_total</td></tr>";
		echo "</table>";
		$LMR_total += $team_total;
		}
	else{echo mysqli_error($conn);}
}
mysqli_close($conn);
?>
<p>Total: <?php echo $LMR_total; ?></p>
</div>
</body>
</html>