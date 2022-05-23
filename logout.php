<?php
	require_once 'sessions.php';	
	check_session();
	$_SESSION = array();
	session_destroy();	
	setcookie(session_name(), 123, time() - 1000); 
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset = "UTF-8">
		<title>Session closed</title>
		<link rel='stylesheet' type='text/css' media='screen' href='main.css'>
	</head>
	<body>
		<p>Session is closed</p>
		<a href = "index.php">Go to login page</a>
	</body>
</html>