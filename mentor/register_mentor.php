<?php
require_once '../db.php';
$ID = (int)trim(mysqli_real_escape_string($conn, $_POST['idfield']));
$ID = filter_var($ID, FILTER_VALIDATE_INT, array("options" => array("min_range"=>10002, "max_range"=>9223372036854775807)));
if (!$ID){
	die("Please choose a valid ID number with at least 5 digits.<br><a href='https://just136.justhost.com/~nemosha1/timeclock/mentor/index.php'>Back</a>");
}

$last = trim(mysqli_real_escape_string($conn, $_POST['last']));
$first = trim(mysqli_real_escape_string($conn, $_POST['first']));
$email = $_POST['email'];
$email = filter_var($email, FILTER_VALIDATE_EMAIL);
$email = trim(mysqli_real_escape_string($conn, $_POST['email']));
$cell = trim(mysqli_real_escape_string($conn, $_POST['cell']));
$shirtsize = trim(mysqli_real_escape_string($conn, $_POST['shirtsize']));
$role = trim(mysqli_real_escape_string($conn, $_POST['role']));
$prog_pref = trim(mysqli_real_escape_string($conn, $_POST['prog_pref']));

if (strlen($last) < 2 || strlen($first) < 2){
	die("Please enter first and last name.<br><a href='https://just136.justhost.com/~nemosha1/timeclock/mentor/index.php'>Back</a>");
}
if (!$email){
	die("Please enter a valid email address.<br><a href='https://just136.justhost.com/~nemosha1/timeclock/mentor/index.php'>Back</a>");
}



$sql = "INSERT INTO students (ID,last,first,email,cell,shirtsize,role,prog_pref, team, gradclass) VALUES ($ID,'$last','$first','$email','$cell','$shirtsize','$role','$prog_pref', 'Mentors', '1950')";
if ($result = mysqli_query($conn,$sql)){
	echo "Submission successful.<br>";
	echo "<a href='https://just136.justhost.com/~nemosha1/timeclock/mentor/index.php'>Back</a>";
} else{
	echo mysqli_error($conn);
	echo "<br><a href='https://just136.justhost.com/~nemosha1/timeclock/mentor/index.php'>Back</a>";
}

mysqli_close($conn);

?>
