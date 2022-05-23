<?php
require_once 'db.php';
// require 'header.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {  
	$user = $_POST['user'];
	$existo=zurron_obtenerHas($_POST['user']);
	if ($existo==FALSE)
		echo "Incorrect user";
	else{
		// var_dump($existo['passwd']);
		// $correcto=password_verify($_POST['password'],$existo['passwd']);
		if(password_verify($_POST['password'],$existo['passwd'])){
			session_start();
			// $usu has two fields: mail and codRes
			// $usu = zurron_check_userMk1($_POST['user'], $existo['passwd']);
			$userInfo=zurron_infoUser($_POST['user']);
			// $_SESSION['user'] = $usu;
			$_SESSION['id']=$userInfo['id'];
			$_SESSION['nick']=$userInfo['nick'];
			if(isset($userInfo['name']))
				$_SESSION['name']=$userInfo['name'];
			if(isset($userInfo['surname']))
				$_SESSION['surname']=$userInfo['surname'];
			if(isset($userInfo['email']))
				$_SESSION['email']=$userInfo['email'];
			if(isset($userInfo['direccion']))
				$_SESSION['direccion']=$userInfo['direccion'];
			if(isset($userInfo['age']))
				$_SESSION['age']=$userInfo['age'];
			if(isset($userInfo['pfp']))
				$_SESSION['pfp']=$userInfo['pfp'];
			// if(isset($userInfo['passwd']))
			// 	$_SESSION['passwd']=$userInfo['passwd'];
			header("Location: test.php");
			// echo "login sucesful";
			return;
		}
		else{
			echo "Correct user, bad password";
		}
	}

}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Login form</title>
		<meta charset = "UTF-8">
		<link rel='stylesheet' type='text/css' media='screen' href='main.css'>
	</head>
	<body>	
		<?php if(isset($_GET["redirected"])){
			echo "<p>Login to continue</p>";
		}?>
		<?php if(isset($err) and $err == true){
			echo "<p>Check user and password</p>";
		}?>
		<form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method = "POST">
			<label for = "user">user</label> 
			<input value = "<?php if(isset($user))echo $user;?>"
			id = "user" name = "user" type = "text">		
			<label for = "password">password</label> 
			<input id = "password" name = "password" type = "password">					
			<input type = "submit" value="Login-In">
			<br>
		</form>
		<a href="./register.php">Register site</a>
	</body>
</html>