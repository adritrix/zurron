<?php
require 'sessions.php';
require 'db.php';
check_session();
$message_id=$_GET['message_id'];
// echo"estas en la pagina correcta y el message_id: ". $_GET['message_id'];
$full_message=zurron_fullmessageMk1($message_id);
$remitente=zurron_obtenerRemitente($message_id);
echo"El remitente es: ". $remitente['nick'];
echo"<br>";
echo"Asunto del mensaje: ". $full_message['subject'];
echo"<br>";
echo"Cuerpo del mensaje: ". $full_message['body'];
echo"<br>";
$marcado=zurron_marcarLeidoMk1($message_id,$_SESSION['id']);
if($marcado==true){
    echo"Mensaje leido";
}else
    echo"Se han cometido errores por lo que el mensaje no se ha marcado como leido";


echo "<br>";
echo "<a href='./logout.php'>Cerrar sesion</a><p>     </p><a href='./test.php'>Volver a bandeja de entrada</a>";
