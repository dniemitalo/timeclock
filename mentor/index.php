<?php
if (! isset($_SERVER['HTTPS']) or $_SERVER['HTTPS'] == 'off' ) {
    header('Location: https://just136.justhost.com/~nemosha1/timeclock/mentor/index.php');
    exit();
}
?>
<!doctype HTML>
<html>
<head>
	<meta name=viewport content="width=device-width">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../timeclock.css">
	<style>
	input, textarea{
		margin-left: 0;
		margin-right: 0;
		width: 100%;
	}
</style>
<script type="text/javascript">
	function validateForm(){
		identry = document.getElementById('idfield').value;
		if(identry.length > 4 && !isNaN(identry)){
			return true;	
		}
		else {
			alert('ID number is not a number and/or is not 5+ digits long.');
			return false;
		}
	}
</script>
</head>
<body>
<h1 class="title">Registration</h1>
<div class="main">
	<form id="regForm" name="regForm" onsubmit="return validateForm();" method = "post" action="https://just136.justhost.com/~nemosha1/timeclock/mentor/register_mentor.php">
		ID Number:<input type="text" id="idfield" name="idfield"><br>
		<em>(You choose the number; all numeric, at least 5 digits)</em><br>
		First Name: <input type="text" name="first"><br>
		Last Name: <input type="text" name="last"><br>
		Email: <input type="text" name="email"><br>
		Cell: <input type="text" name="cell"><br>
		T-Shirt Size<br>
		<select name="shirtsize">
			<option>Select Size</option>
			<option value="S">Small</option>
			<option value="M">Medium</option>
			<option value="L">Large</option>
			<option value="XL">X-Large</option>
			<option value="XXL">2X-Large</option>
			<option value="XXXL">3X-Large</option>
		</select><br>
		</br>
		<strong>What sort of role would you like to have in Linn-Mar Robotics? (if known)</strong><br>
		<textarea name="role" rows="6"></textarea><br>
		<br>
		<strong>FIRST program preference</strong><br>
		<select name="prog_pref">
			<option value="undecided">Undecided / Don't Know</option>
			<option value="none">No preference</option>
			<option value="FTC">FTC (FIRST Tech Challenge)</option>
			<option value="FRC">FRC (FIRST Robotics Competition)</option>
		</select><br>
		<br>
		<input type="submit" value="Submit" onclick="submitClicked();">
	</form>
</div>
<h1 class="title"><a href="http://www.nemoquiz.com/timeclock">Back to Time Clock</a></h1>
</body>
</html>