<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <title>Message</title>
</head>
<body>
<?php
require 'sessions.php';
require 'db.php';
check_session();
require 'header.php';
getHeader();


$message_id=$_GET['message_id'];
require 'senderInfo.php';
getSenderHeader($message_id);
// echo"estas en la pagina correcta y el message_id: ". $_GET['message_id'];
$full_message=zurron_fullmessageMk1($message_id);
$remitente=zurron_obtenerRemitente($message_id);
echo "<div style='border: 1px solid white'>";
echo "<p style= 'color:blue'><b>". $full_message['subject']."</b></p>";
echo "<p style= 'color:red'><b>Sender---> ". $remitente['nick']."</b></p>";
echo $full_message['body'];
echo"<br>";
echo "</div>";
echo"<br>";
$marcado=zurron_marcarLeidoMk1($message_id,$_SESSION['id']);
if($marcado==true){
    echo"<b><p style='color: green'>Mensaje leido</p></b>";
// 
}else{
//     echo"Se han cometido errores por lo que el mensaje no se ha marcado como leido";
}
// __________________________________________
if ($_SERVER["REQUEST_METHOD"] == "POST") {  	
	
    // echo "regrese <br>";
	// echo $_POST['Asunto']."<br>";
	// echo $_POST['Mensaje']."<br>";
	$targetSeleccionado=[];
    $remitente_id=zurron_obtenerRemitenteID($message_id);
    array_push($targetSeleccionado,$remitente_id['id']);
    $reAsunto="RE: ".$full_message['subject'];
	
	if(count($targetSeleccionado)==0)
		echo "Selecciona al menos un destinatario";
    
    else{
        // echo $reAsunto."<br>";
        // echo $_POST['Mensaje']."<br>";
        // echo $remitente_id['id']."<br>";
        // echo $targetSeleccionado[0]."<br>";
        // var_dump($targetSeleccionado."<br>");
        $crearMensaje=zurron_crearMensaje($reAsunto,$_POST['Mensaje'],$_SESSION['id'],$targetSeleccionado);
        if($crearMensaje==true)
            echo"<b><p style='color: green'>TextBack Sent</p></b>";
        else
            echo"<b><p style='color: red'>Error en the generation of response</p></b>";

        }
   

    
}  
// __________________________________________

?>

    <form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"])."?message_id=".$message_id;?>" method = "POST">
        <br>						
        Answer
        <!-- <input type="text" size="800" name = "Mensaje"> -->
        <textarea id="Mensaje" name="Mensaje" rows="4" cols="50"></textarea>
        <input type = "submit" value="TextBack">
    </form>

    <?php
    echo "<br>";
    echo "<a href='./logout.php'>Close Sesion</a><p>     </p><a href='./test.php'>Main page</a>";
    ?>
</body>
</html>