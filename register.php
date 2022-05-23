<!-- <?php
    $texto="hola";
    $texto2="holas";
    $hash=password_hash($texto,PASSWORD_DEFAULT,);
    if (password_verify($texto2,$hash))
        echo "hola bro";
    else   
        echo "no hoes en yha house";
    ?> -->
<?php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {  
	
	
    $contra=$_POST['password'];
    $nombre=$_POST['user'];
    $hash=password_hash($contra,PASSWORD_BCRYPT);
    $listaNicks=zurron_obtenerNicks();
    $pillado=FALSE;
    foreach ($listaNicks as $nk){
        if ($nombre==$nk['nick'])
            $pillado=TRUE;
    }

    if ($pillado==TRUE)
        echo "Nick alrreadi in use, please try with another option";
    else{
        $registro=zurron_insertCrypt($nombre,$hash);
        if ($registro==TRUE){
            echo "New user registered, in 7 seconds you wil be redirected to the Login page, you can alse click the lin below <br>";
            sleep(7);
            header("Location: index.php");
        }
        else
            echo "Something went wrong";
        }

}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Register</title>
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
			<label for = "user">Insert new user´s nick</label> 
			<input value = "<?php if(isset($user))echo $user;?>"
			id = "user" name = "user" type = "text">		
			<label for = "password">Insert new user´s password</label> 
			<input id = "password" name = "password" type = "password">					
			<input type = "submit" value="Sign-In">
            <br>
            <a href="./index.php">Login page</a></a>
            
		</form>
	</body>
</html>