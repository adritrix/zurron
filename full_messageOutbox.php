<?php
require 'sessions.php';
require 'db.php';
check_session();
require 'header.php';
getHeader();
$message_id=$_GET['message_id'];
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

echo "<br>";
$leidos=zurron_QuienLeyo($message_id);
echo "<div style='border: 1px solid white'>";
echo "<p style= 'color:blue'><b>¿Double blue tick?</b></p>";
foreach ($leidos  as $line) {
    if ($line['read']==1)
        echo "<b>The user: <-->".$line['nick']. "<--> read the text"."</b><br>";
    else
        echo "The user: <-->".$line['nick']. "<--> hasn´t read the text"."<br>";
}
echo "</div>";
echo "<a href='./logout.php'>Close Sesion</a><p>     </p><a href='./test.php'>Main page</a>";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <title>Outbox</title>
</head>
<body>
    
</body>
</html>
