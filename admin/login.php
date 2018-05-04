<?php
if (! isset($_SERVER['HTTPS']) or $_SERVER['HTTPS'] == 'off' ) {
    header('Location: https://just164.justhost.com/~nemosha1/timeclock/admin/login.php');
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Log In</title>
	<meta name=viewport content="width=device-width">
	<link rel="stylesheet" type="text/css" href="../timeclock.css">
</head>
<body>
<div class="main">
<form action="https://just164.justhost.com/~nemosha1/timeclock/admin/auth.php" method="post">
<p>
<?php
if (isset($_SESSION['flash_error'])){
	echo $_SESSION['flash_error'];
}
?>

</p>
<label for="username">Username: </label><input type="text" name="username"><br>
<label for="password">Password: </label><input type="password" name="password"><br>
<input type="submit" id ="submitButton" value="Log In">
</form>
</div>
</body>
</html>