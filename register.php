<!DOCTYPE html>
<?php
require_once 'db.php';
?>
<html>
<head>
	<meta http-equiv="refresh" content="5;URL=http://www.nemoquiz.com/timeclock">
	<link rel="stylesheet" type="text/css" href="timeclock.css">
</head>
<body>
<div class="title"><h1>Robotics Time Clock</h1></div>
<div class="main">
<?php
$sql = "INSERT INTO students (ID, first, last) VALUES ($_POST[ID],'$_POST[first]','$_POST[last]')";
if ($result = mysqli_query($conn,$sql)){
	?>
	<p>New user created successfully.</p>
	<p>Note: you are not punched in yet.</p>
	<p>Redirecting to time clock in 5 seconds...</p>
	<p><a href="http://www.nemoquiz.com/timeclock">Click here</a> if you are not redirected automatically.</p>

	<?php
}
else{
	echo mysqli_error($conn);
}
?>
</div>
</body>
</html>

<?php
$conn->close();
?>
