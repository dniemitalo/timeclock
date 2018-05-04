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
$idfield = $_GET['idfield'];
require_once '../db.php';
$sql = "SELECT * FROM students WHERE ID=$idfield";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
mysqli_close($conn);
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
	<p><a href="https://just164.justhost.com/~nemosha1/timeclock/admin/logout.php">Log Out</a><br></p>
	<p><a href="https://just164.justhost.com/~nemosha1/timeclock/admin/dashboard.php">Back to Dashboard</a></p>
	<form id="regForm" action="https://just164.justhost.com/~nemosha1/timeclock/admin/update_student.php" method="post">
		First Name: <input type="text" id="first" name="first" value='<?php echo $row['first']; ?>'><br>
		Last Name: <input type="text" id="last" name="last" value='<?php echo $row['last']; ?>'><br>
		Email: <input type="text" id="email" name="email" value='<?php echo $row['email']; ?>'><br>
		Cell:
		<input type="text" id="cell" name="cell" value='<?php echo $row['cell']; ?>'><br>
		Graduating Class 
		<select id="gradclass" name="gradclass">
			<option>Select Graduating Class</option>
			<option value = 2018>2018</option>
			<option value = 2019>2019</option>
			<option value = 2020>2020</option>
			<option value = 2021>2021</option>
			<option value = 2022>2022</option>
			<option value = 2023>2023</option>
			<option value = 2024>2024</option>
			<option value = 1950>NA</option>
		</select><br>
		T-Shirt Size 
		<select id="shirtsize" name="shirtsize">
			<option>Select Size</option>
			<option value="S">Small</option>
			<option value="M">Medium</option>
			<option value="L">Large</option>
			<option value="XL">X-Large</option>
			<option value="XXL">2X-Large</option>
			<option value="XXXL">3X-Large</option>
		</select><br>
		LM ID card number: <input type="text" id="idfield" name="idfield" value='<?php echo $row['ID']; ?>' maxlength="10" size="10"><br>
		LM Computer Login: <input type="text" id="server_login" name="server_login" value='<?php echo $row['server_login']; ?>' maxlength="28" size="14"><br>
		LM Computer Password: <input type="text" id="server_password" name="server_password" maxlength="8" size="8"><br>
		<strong>Parent/Guardian 1:</strong><br>
		First Name: <input type="text" id="guardian1first" name="guardian1first" value='<?php echo $row['guardian1first']; ?>'><br>
		Last Name: <input type="text" id="guardian1last" name="guardian1last" value='<?php echo $row['guardian1last']; ?>'><br>
		Email: <input type="text" id="guardian1email" name="guardian1email" value='<?php echo $row['guardian1email']; ?>'><br>
		Cell: <input type="text" id="guardian1cell" name="guardian1cell" value='<?php echo $row['guardian1cell']; ?>'><br>
		<br>
		<strong>Parent/Guardian 2 (if applicable):</strong><br>
		First Name: <input type="text" id="guardian2first" name="guardian2first" value='<?php echo $row['guardian2first']; ?>'><br>
		Last Name: <input type="text" id="guardian2last" name="guardian2last" value='<?php echo $row['guardian2last']; ?>'><br>
		Email: <input type="text" id="guardian2email" name="guardian2email" value='<?php echo $row['guardian2email']; ?>'><br>
		Cell: <input type="text" id="guardian2cell" name="guardian2cell" value='<?php echo $row['guardian2cell']; ?>'><br>
		<br>
		<strong>Other Activities</strong><br>
		<textarea id="activities" name="activities" rows="3"><?php echo $row['activities']; ?></textarea><br>
		<strong>Availability</strong><br>
		<textarea id="availability" name="availability" rows="3"><?php echo $row['availability']; ?></textarea><br>
		<strong>What can you bring to Linn-Mar Robotics?</strong><br>
		<textarea id="bring" name="bring" rows="6"><?php echo $row['bring']; ?></textarea><br>
		<strong>What sort of role would you like to have in Linn-Mar Robotics?</strong><br>
		<textarea id="role" name="role" rows="3"><?php echo $row['role']; ?></textarea><br>
		<strong>Coach / Mentor Comments</strong><br>
		<textarea id="comments" name="comments" rows="6"><?php echo $row['comments']; ?></textarea><br>
		<strong>FIRST program preference</strong>
		<select id="prog_pref" name="prog_pref">
			<option value="undecided">Undecided / Don't Know</option>
			<option value="none">No preference</option>
			<option value="FTC">FTC (FIRST Tech Challenge)</option>
			<option value="FRC">FRC (FIRST Robotics Competition)</option>
		</select><br>
		<strong>Preferred LM Robotics Team</strong>
		<select id="team_pref" name="team_pref">
			<option value="undecided">Undecided / Don't Know</option>
			<option value="none">No preference</option>			
			<option value="967">967 Iron Lions (FRC)</option>
			<option value="4150">4150 Dark Matter (FTC)</option>
			<option value="4324">4324 Lost in Time (FTC)</option>
			<option value="10107">10107 A League of Their Own (FTC)</option>
		</select><br>
		Team: <select id='team' name='team'>
		<option value=''>Unassigned</option>
		<option value='967'>967 FRC</option>
		<option value='4150'>4150 DM</option>
		<option value='4324'>4324 LiT</option>
		<option value='10107'>10107 ALoTO</option>
		<option value='Mentors'>Mentor/Volunteer</option>
		</select></td> 
		<br>
 		<input type="submit" value="Submit">
	</form>
	<div id="status"></div>
</div>
</body>
<script>
document.getElementById('gradclass').value = '<?php echo $row['gradclass']; ?>' ;
document.getElementById('shirtsize').value = '<?php echo $row['shirtsize']; ?>' ;
document.getElementById('prog_pref').value = '<?php echo $row['prog_pref']; ?>' ;
document.getElementById('team_pref').value = '<?php echo $row['team_pref']; ?>' ;
document.getElementById('team').value = '<?php echo $row['team']; ?>' ;
</script>
</html>