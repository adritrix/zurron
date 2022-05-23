<?php
require_once 'sessions.php';
require 'db.php';
check_session();
require 'header.php';
getHeader();


if ($_SERVER["REQUEST_METHOD"] == "POST") {  	
	
    // echo "regrese <br>";
	// echo $_POST['Asunto']."<br>";
	// echo $_POST['Mensaje']."<br>";
	if (!$_POST['Mensaje'])
		echo"<b><p style='color: red'>Error en the generation of Text, A text body is required to send a message</p></b>";
	else{
	if (!$_POST['Asunto'])
		echo"<b><p style='color: red'>Error en the generation of Text, A text subject is required</p></b>";
	else{
	$targetSeleccionado=[];
	foreach($_POST as $key=>$valor){
		if ($key!="Asunto" && $key!="Mensaje" && $valor=="on"){
			// $key."<br>";
			array_push($targetSeleccionado,$key);
		}

	}
	if(count($targetSeleccionado)==0)
		echo "Altleast one user has to be selected to send the text";
	else{
	$crearMensaje=zurron_crearMensaje($_POST['Asunto'],$_POST['Mensaje'],$_SESSION['id'],$targetSeleccionado);
	if($crearMensaje==true)
		echo"<b><p style='color: green'>Text sent</p></b>";
	else
		echo"<b><p style='color: red'>Error en the generation of Text</p></b>";

	}
	}
}
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>NewText</title>		
		<meta charset = "UTF-8">
		<link rel='stylesheet' type='text/css' media='screen' href='main.css'>
	</head>
	<body>	
				
		<!-- <?php 
			if ($_SERVER["REQUEST_METHOD"] == "POST"){
				if(isset($err)){	
					echo "<p style = 'color:red'> Error inserting: $message </p>
						<p style = 'color:red'>$messageBD</p>";
				}else{
					echo "<p>$message</p>";  
				}
			}
		?> -->

		<form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method = "POST">
			TextSubject
			<input type="text" id="Asunto" name = "Asunto">	
			<br>						
			Text
			<!-- <input type="text" size="800" name = "Mensaje"> -->
			<textarea id="Mensaje" name="Mensaje" rows="4" cols="50"></textarea>
			<?php
			echo "<br>";
			$posiblesTargets=zurron_posiblesTargets($_SESSION['id']);
			foreach ($posiblesTargets as $target){
				// echo $target['nick']."<-->". $target['id']."<br>";
				echo "<input type='checkbox' id=".$target['id']." name=".$target['id'].">";
				echo "<label for=".$target['id'].">".$target['nick']."</label><br>";
			}
			?>
			<input type = "submit" value="SendText">
		</form>
		<?php
		echo "<br><a href='./logout.php'>Close sesion</a> <br>";
		echo "<br><a href='./test.php'>Main Page</a><br";
		?>
	</body>
</html>