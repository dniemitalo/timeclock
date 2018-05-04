<!DOCTYPE html>
<?php require_once 'db.php'; ?>
<html>
<head>
	<meta http-equiv="refresh" content="3;URL=http://www.nemoquiz.com/timeclock">
	<meta name=viewport content="width=device-width">
	<link rel="stylesheet" type="text/css" href="timeclock.css">
</head>
<body>
<div class="title"><h1>Robotics Time Clock</h1></div>
<div class="main">

<?php
function punch($names, $conn, $type){
	if ($type==0) $typetext = 'OUT';
	if ($type==1) $typetext = 'IN';
	$sql = "UPDATE students SET punched_in = $type WHERE ID={$_POST['ID']}";
	if (mysqli_query($conn,$sql)) 
		echo "User {$_POST['ID']}, {$names['first']} {$names['last']}, is now punched $typetext.<br>";	
	else echo mysqli_error($conn);

	$sql = "INSERT INTO punches (ID, time, type) VALUES ({$_POST['ID']}, ADDTIME(NOW(), '1:00:00'),$type)";
	if (mysqli_query($conn,$sql)){
	}
	else{
		echo mysqli_error($conn);
	}
}

function hours($conn, $user){
	$sql = "SELECT TIMESTAMPDIFF(MINUTE,(SELECT time FROM punches WHERE ID = $user ORDER BY time DESC LIMIT 1),ADDTIME(NOW(), '1:00:00'))";
	if ($minute_array = mysqli_query($conn,$sql)){ 
		$minutes = mysqli_fetch_row($minute_array);
		$hours = round($minutes[0] / 60.0,2);	
		echo "<p>You have logged $hours hours.</p>";
		$sql = "INSERT INTO hours (ID, hours, date) VALUES ($user,$hours,ADDTIME(NOW(), '1:00:00'))";
		if (mysqli_query($conn,$sql)) {}
		//echo "<p>Time has been logged in the database.</p>";	
		else echo mysqli_error($conn);
	}
	else echo mysqli_error($conn);
}

function accumulated_hours($conn, $user){
	$sql = "SELECT SUM(hours) as total_hours FROM hours WHERE ID=$user AND hours.date > '2017-08-19'";
	if ($total_result = mysqli_query($conn,$sql)){ 
		$hours = round(mysqli_fetch_row($total_result)[0],2);
		echo "<p>You have logged a total of $hours hours this season.</p>";
		}
	else echo mysqli_error($conn);
}

//Check if user is registered
$sql = "SELECT ID, first, last FROM students WHERE ID='{$_POST['ID']}'";
if ($result = mysqli_query($conn,$sql)){
	$names = mysqli_fetch_assoc($result); 
	if (empty($names['first']) || empty($names['last'])) {
		$conn->close();
		header("location: http://www.nemoquiz.com/timeclock/reg_redirect2.php?ID={$_POST['ID']}");
		die('Redirecting back to main page.');
	}
	//If user is registered, proceed with punch in/out:
	//Find the student's most recent punch that is from the current date.
	//The result will be an empty set (zero rows) if there's no punch from today.
	$sql = "SELECT type, time FROM (SELECT * FROM punches WHERE ID={$_POST['ID']} ORDER BY time DESC LIMIT 1) as custom WHERE DATE(time) = CURDATE()";
	if ($result = mysqli_query($conn,$sql)){
		if (mysqli_num_rows($result)!=0){
		    $type_array = mysqli_fetch_assoc($result);
		    $type = $type_array['type'];
		    //Type 1 means punch IN and Type 0 means punch OUT
		    //User punched in (1) most recently today. Punch them out (0).
		    if ($type == 1){
		    	//Log hours into hours table when punching out.
		    	//Hours function must come first so we can do NOW() minus most recent timestamp
		    	hours($conn,$_POST['ID']);
		    	accumulated_hours($conn,$_POST['ID']);
		    	punch($names, $conn,0);
		    }
		    else {
		    	punch($names, $conn,1);
		    	accumulated_hours($conn,$_POST['ID']);}
		    	//User has punched in and out already today. Punch them back in (1).
		}
		else {
			punch($names, $conn,1);
			accumulated_hours($conn,$_POST['ID']);}
			//User has no punches yet today. Punch them in(1).
	}
	else{
		echo mysqli_error($conn);
	}
}
else{
	echo mysqli_error($conn);
}
?>

</div>
<div class="divbutton"><a class="clickable" href="http://www.nemoquiz.com/timeclock">Go Back</a></div>
</body>
</html>

<?php $conn->close(); ?>