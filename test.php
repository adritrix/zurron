<?php
require_once 'sessions.php';
require 'db.php';
// require 'header.php';
check_session();
require 'header.php';
// $hola=zurron_queryMk1();

// var_dump($hola);

// var_dump($_SESSION['pepe']);


// $papiro=zurron_queryMk2($_SESSION['user'][1]);
// zurron_queryMk3($_SESSION['nick']);

getHeader();

$inbox=zurron_queryMk4($_SESSION['nick']);

echo "<div style='border: 3px solid black'>";
echo "<p style= 'color:blue'><b>Inbox</b></p>";
if ($inbox){
    foreach ($inbox  as $line) {
        $message_id=$line['message_id'];
        
        $remitente=zurron_obtenerRemitente($message_id);
        
        if($line['read']==0){
            // print "<b>Mensaje id: " . $line['message_id'] ." Sujeto: " .$line['subject']. " Cuerpo: " .$line['body']
            // . " Remitente: " .$remitente['nick']
            // . "</b>";
            // echo "<a href='./full_messageInbox.php?message_id=$message_id'>Ir a mensaje</a>";
            echo "<div style='border: 1px solid white; margin: 20px' >";
            echo " <b><div style='color: purple; font-weight: bolder; border: 0px solid orange;margin: 8px'>Subject---> " .$line['subject']
            . "</div> <div style='color: purple; font-weight: bolder; border: 0px solid orange;margin: 8px'>Sender----> " .$remitente['nick']
            . "</div></b>";
            echo "<a href='./full_messageInbox.php?message_id=$message_id'>See Message</a>";
            echo "<br>";
            echo "</div>";
        }
        else{
            // print "Mensaje id: " . $line['message_id'] . " Sujeto: " .
            // $line['subject']. " Cuerpo: " .$line['body']. " Remitente : ". $remitente['nick'];
            // echo "<a href='./full_messageInbox.php?message_id=$message_id'>Ir a mensaje</a>";
            echo "<div style='border: 1px solid white; margin: 20px' >";
            echo " <div style='border: 0px solid orange;margin: 8px'>Subject---> " .$line['subject']
            . "</div> <div style='border: 0px solid orange;margin: 8px'>Sender---> " .$remitente['nick']."</div>";
            echo "<a href='./full_messageInbox.php?message_id=$message_id'>See Message</a>";
            echo"<br>";
            echo "</div>";
        }
    }
    
}
else
    echo "Thre is no text in the inbox";
echo "</div>";


$outbox=zurron_Outbox($_SESSION['id']);
print "<br>";


echo "<div style='border: 3px solid black'>";
echo "<p style= 'color:red'><b>Outbox</b></p>";
if ($outbox){
foreach ($outbox  as $line) {
    $message_id=$line['message_id'];
    
    $remitente=zurron_obtenerRemitente($message_id);
    echo "<div style='border: 1px solid white; margin: 20px' >";
    print "<div style='border: 0px solid orange;margin: 8px'>Mensaje id---> " . $line['message_id'] ." </div><div style='border: 0px solid orange;margin: 8px'>
    Subject---> " .$line['subject']. "</div>";
    echo "<a href='./full_messageOutbox.php?message_id=$message_id'>See Message</a>";
    print "<br>";
    echo "</div>";
    }
}
else
    echo "Thre is no text in the Outbox";
echo "</div>";







echo "<a href='./logout.php'>Close sesion</a> <br>";
echo "<a href='./redactarMensaje.php'>Create new text</a> <br>";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <title>Main page</title>
</head>
<body>
    
</body>
</html>