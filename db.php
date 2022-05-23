<?php

function load_config($name, $schema){
	$config = new DOMDocument();
	$config->load($name);
	$res = $config->schemaValidate($schema);
	if ($res===FALSE){ 
	   throw new InvalidArgumentException("Check configuration file");
	} 		
	$data = simplexml_load_file($name);	
	$ip = $data->xpath("//ip");
	$name = $data->xpath("//name");
	$user = $data->xpath("//user");
	$password = $data->xpath("//password");	
	$conn_string = sprintf("mysql:dbname=%s;host=%s", $name[0], $ip[0]);
	$result = [];
	$result[] = $conn_string;
	$result[] = $user[0];
	$result[] = $password[0];
	return $result;
}

// #######################################################################################

function zurron_queryMk1(){
	$res = load_config(dirname(__FILE__)."/configuration.xml", dirname(__FILE__)."/configuration.xsd");
	$db = new PDO($res[0], $res[1], $res[2]);
	$ins = "SELECT message.message_id, message.subject, message.subject, message.body, message.sender 
	FROM message, targets 
	WHERE message_id=targets.tmessage_id and targets.target_id LIKE 3 and targets.read=0;";
	$resul = $db->query($ins);	
	if($resul->rowCount() === 1){		
		return $resul->fetch();		
	}else{
		return FALSE;
	}
}


function zurron_check_userMk1($name, $password){
	$res = load_config(dirname(__FILE__)."/configuration.xml", dirname(__FILE__)."/configuration.xsd");
	$db = new PDO($res[0], $res[1], $res[2]);
	$ins = "SELECT nick, passwd from users WHERE nick= '$name' AND passwd='$password'";
	$resul = $db->query($ins);	
	if($resul->rowCount() === 1){		
		return $resul->fetch();		
	}else{
		return FALSE;
	}
}

function zurron_infoUser($nick){ // Sentecia para mostrar todos los mensajes de un ususario
	$res = load_config(dirname(__FILE__)."/configuration.xml", dirname(__FILE__)."/configuration.xsd");
	$db = new PDO($res[0], $res[1], $res[2]);
	// $ins = "SELECT users.id, users.nick, users.name, users.surname, users.surname
	// FROM users
	// WHERE users.nick like '$nick';";
	$ins = "SELECT *
	FROM users
	WHERE users.nick like '$nick';";
	$resul = $db->query($ins);	
	if($resul->rowCount() >=1){		
		return $resul->fetch();		
	}else{
		return FALSE;
	}
}

function zurron_queryMk3($nick){ // Sentecia para mostrar todos los mensajes de un ususario con listado de lineas en una misma funcio
	$res = load_config(dirname(__FILE__)."/configuration.xml", dirname(__FILE__)."/configuration.xsd");
	$db = new PDO($res[0], $res[1], $res[2]);
	$ins = "SELECT message.message_id, message.subject, message.body, message.sender 
	FROM message, targets 
	WHERE message_id=targets.tmessage_id and targets.target_id LIKE (SELECT users.id FROM users WHERE users.nick like '$nick');";
	$resul = $db->query($ins);	
	if($resul->rowCount() >=1){		
		foreach ($resul  as $line) {
			echo "Mensaje id: " . $line['message_id'] . "Sujeto: " .
			$line['subject']. "Cuerpo: " .$line['body']. "Emisario id: " .$line['sender']. "<br>";
		}		
	}else{
		return FALSE;
	}
}

function zurron_queryMk4($nick){ // Sentecia para mostrar todos los mensajes de un ususario pero se devuleve un array con las lineas
	$res = load_config(dirname(__FILE__)."/configuration.xml", dirname(__FILE__)."/configuration.xsd");
	$db = new PDO($res[0], $res[1], $res[2]);
	$ins = "SELECT 
		message.message_id, 
		message.subject, 
		message.body, 
		message.sender, 
		targets.read
	FROM message, targets 
	WHERE message_id=targets.tmessage_id and targets.target_id LIKE (SELECT users.id FROM users WHERE users.nick like '$nick');";
	$resul = $db->query($ins);	
	if($resul->rowCount() >=1){		
		return $resul;	
	}else{
		return FALSE;
	}
}

function zurron_fullmessageMk1($message_id){ // Sentecia para mostrar todos los mensajes de un ususario pero se devuleve un array con las lineas
	$res = load_config(dirname(__FILE__)."/configuration.xml", dirname(__FILE__)."/configuration.xsd");
	$db = new PDO($res[0], $res[1], $res[2]);
	$ins = "SELECT 
		message.message_id, 
		message.subject, 
		message.body, 
		message.sender 
	FROM message
	WHERE message_id=$message_id;";
	$resul = $db->query($ins);	
	if($resul->rowCount() >=1){		
		return $resul->fetch();	
	}else{
		return FALSE;
	}
}

function zurron_obtenerRemitente($message_id){ // Sentecia para mostrar todos los mensajes de un ususario pero se devuleve un array con las lineas
	$res = load_config(dirname(__FILE__)."/configuration.xml", dirname(__FILE__)."/configuration.xsd");
	$db = new PDO($res[0], $res[1], $res[2]);
	$ins = "SELECT users.nick FROM users,message WHERE users.id=message.sender and message.message_id=$message_id;";
	$resul = $db->query($ins);	
	if($resul->rowCount() >=1){		
		return $resul->fetch();		
	}else{
		return FALSE;
	}
}

function zurron_obtenerRemitenteID($message_id){ // Sentecia para mostrar todos los mensajes de un ususario pero se devuleve un array con las lineas
	$res = load_config(dirname(__FILE__)."/configuration.xml", dirname(__FILE__)."/configuration.xsd");
	$db = new PDO($res[0], $res[1], $res[2]);
	$ins = "SELECT users.id FROM users,message WHERE users.id=message.sender and message.message_id=$message_id;";
	$resul = $db->query($ins);	
	if($resul->rowCount() >=1){		
		return $resul->fetch();		
	}else{
		return FALSE;
	}
}

function zurron_marcarLeidoMk1($message_id,$target_id){ // Sentecia para mostrar todos los mensajes de un ususario pero se devuleve un array con las lineas
	$res = load_config(dirname(__FILE__)."/configuration.xml", dirname(__FILE__)."/configuration.xsd");
	$db = new PDO($res[0], $res[1], $res[2]);
	$db->beginTransaction();
	$ins = "UPDATE targets SET targets.read=1 WHERE targets.tmessage_id=$message_id and targets.target_id=$target_id;";
	$resul = $db->query($ins);	
	if($resul->rowCount() ==1){		
		$db->commit();
		return TRUE;	
	}else{
		$db->rollBack();
		return FALSE;
	}
}

function zurron_Outbox($sender_id){ // Sentecia para mostrar todos los mensajes de un ususario pero se devuleve un array con las lineas
	$res = load_config(dirname(__FILE__)."/configuration.xml", dirname(__FILE__)."/configuration.xsd");
	$db = new PDO($res[0], $res[1], $res[2]);
	$ins = "SELECT 
	message.message_id, 
	message.subject, 
	message.body 
	FROM message
	WHERE message.sender=$sender_id
	ORDER by message_id DESC;";
	$resul = $db->query($ins);	
	if($resul->rowCount() >=1){		
		return $resul;	
	}else{
		return FALSE;
	}
}

function zurron_QuienLeyo($message_id){ // Sentecia para mostrar todos los mensajes de un ususario pero se devuleve un array con las lineas
	$res = load_config(dirname(__FILE__)."/configuration.xml", dirname(__FILE__)."/configuration.xsd");
	$db = new PDO($res[0], $res[1], $res[2]);
	$ins = "SELECT users.nick, targets.read 
	from targets, users 
	WHERE targets.tmessage_id=$message_id
	and targets.target_id=users.id;";
	$resul = $db->query($ins);	
	if($resul->rowCount() >=1){		
		return $resul;	
	}else{
		return FALSE;
	}
}

function zurron_posiblesTargets($sender_id){ // Sentecia para mostrar todos los mensajes de un ususario pero se devuleve un array con las lineas
	$res = load_config(dirname(__FILE__)."/configuration.xml", dirname(__FILE__)."/configuration.xsd");
	$db = new PDO($res[0], $res[1], $res[2]);
	$ins = "SELECT users. nick, users.id FROM users WHERE users.id!=$sender_id;";
	$resul = $db->query($ins);	
	if($resul->rowCount() >=1){		
		return $resul;	
	}else{
		return FALSE;
	}
}

function zurron_obtenerMensaje_id($sender_id){ // Sentecia para mostrar todos los mensajes de un ususario pero se devuleve un array con las lineas
	$res = load_config(dirname(__FILE__)."/configuration.xml", dirname(__FILE__)."/configuration.xsd");
	$db = new PDO($res[0], $res[1], $res[2]);
	$ins = "select message.message_id FROM message WHERE message.sender=$sender_id ORDER by message.message_id DESC LIMIT 1;";
	$resul = $db->query($ins);	
	if($resul->rowCount() >=1){		
		return $resul->fetch();	
	}else{
		return FALSE;
	}
}

function zurron_crearMensaje($subject,$body,$sender_id,$tagets){ // Sentecia para mostrar todos los mensajes de un ususario pero se devuleve un array con las lineas
	$res = load_config(dirname(__FILE__)."/configuration.xml", dirname(__FILE__)."/configuration.xsd");
	$db = new PDO($res[0], $res[1], $res[2]);
	// $db->beginTransaction();
	$ins = "INSERT INTO message (message.subject,message.body,message.sender) VALUES ('$subject','$body',$sender_id)";
	// $ins2 = "select message.message_id FROM message WHERE message.sender=$sender_id ORDER by message.message_id DESC LIMIT 1;";
	$resul = $db->query($ins);
	
	foreach($tagets as $target){
		 zurron_crearTargets($target,$sender_id);
	}	
	if($resul->rowCount() ==1){		
		// $db->commit();
		return TRUE;	
	}else{
		$db->rollBack();
		// return FALSE;
	}
}

function zurron_crearTargets($taget,$sender_id){ // Sentecia para mostrar todos los mensajes de un ususario pero se devuleve un array con las lineas
	$res = load_config(dirname(__FILE__)."/configuration.xml", dirname(__FILE__)."/configuration.xsd");
	$db = new PDO($res[0], $res[1], $res[2]);
	// $db->beginTransaction();
	$message_id=zurron_obtenerMensaje_id($sender_id);
	// var_dump("Valor del mesage_id====>",$message_id['message_id']);	
	$message_id2=$message_id['message_id'];
	$ins = "INSERT INTO targets (targets.tmessage_id, targets.target_id, targets.read) VALUES ($message_id2,$taget,0);";
	$resul = $db->query($ins);
	if($resul->rowCount() ==1){		
		// $db->commit();
		return TRUE;	
	}else{
		// $db->rollBack();
		return FALSE;
	}
}
function zurron_obtenerNicks(){ // Sentecia para mostrar todos los mensajes de un ususario pero se devuleve un array con las lineas
	$res = load_config(dirname(__FILE__)."/configuration.xml", dirname(__FILE__)."/configuration.xsd");
	$db = new PDO($res[0], $res[1], $res[2]);
	$ins = "select users.nick from users;";
	$resul = $db->query($ins);	
	if($resul->rowCount() >=1){		
		return $resul;
	}else{
		return FALSE;
	}
}

function zurron_obtenerHas($nombre){ // Sentecia para mostrar todos los mensajes de un ususario pero se devuleve un array con las lineas
	$res = load_config(dirname(__FILE__)."/configuration.xml", dirname(__FILE__)."/configuration.xsd");
	$db = new PDO($res[0], $res[1], $res[2]);
	$ins = "select users.nick, users.passwd FROM users WHERE users.nick LIKE'$nombre';";
	$resul = $db->query($ins);	
	if($resul->rowCount() >=1){		
		return $resul->fetch();
	}else{
		return FALSE;
	}
}

function zurron_insertCrypt($nick,$passwd){ // Sentecia para mostrar todos los mensajes de un ususario pero se devuleve un array con las lineas
	$res = load_config(dirname(__FILE__)."/configuration.xml", dirname(__FILE__)."/configuration.xsd");
	$db = new PDO($res[0], $res[1], $res[2]);
	$db->beginTransaction();
	$ins = "INSERT INTO users (users.nick, users.passwd) VALUES ('$nick','$passwd');";
	$resul = $db->query($ins);	
	if($resul->rowCount() ==1){		
		$db->commit();
		return TRUE;	
	}else{
		$db->rollBack();
		// return FALSE;
	}
}

function zurron_infoSender($id){ // Sentecia para mostrar todos los mensajes de un ususario
	$res = load_config(dirname(__FILE__)."/configuration.xml", dirname(__FILE__)."/configuration.xsd");
	$db = new PDO($res[0], $res[1], $res[2]);
	// $ins = "SELECT users.id, users.nick, users.name, users.surname, users.surname
	// FROM users
	// WHERE users.nick like '$nick';";
	$ins = "SELECT *
	FROM users
	WHERE users.id like $id;";
	$resul = $db->query($ins);	
	if($resul->rowCount() >=1){		
		return $resul->fetch();		
	}else{
		return FALSE;
	}
}

function zurron_cambiarNombre($name,$user_id){ // Sentecia para mostrar todos los mensajes de un ususario pero se devuleve un array con las lineas
	$res = load_config(dirname(__FILE__)."/configuration.xml", dirname(__FILE__)."/configuration.xsd");
	$db = new PDO($res[0], $res[1], $res[2]);
	$db->beginTransaction();
	$ins = "UPDATE users SET users.name='$name' WHERE users.id=$user_id;";
	$resul = $db->query($ins);	
	if($resul->rowCount() ==1){		
		$db->commit();
		return TRUE;	
	}else{
		$db->rollBack();
		return FALSE;
	}
}
function zurron_cambiarApellido($surname,$user_id){ // Sentecia para mostrar todos los mensajes de un ususario pero se devuleve un array con las lineas
	$res = load_config(dirname(__FILE__)."/configuration.xml", dirname(__FILE__)."/configuration.xsd");
	$db = new PDO($res[0], $res[1], $res[2]);
	$db->beginTransaction();
	$ins = "UPDATE users SET users.surname='$surname' WHERE users.id=$user_id;";
	$resul = $db->query($ins);	
	if($resul->rowCount() ==1){		
		$db->commit();
		return TRUE;	
	}else{
		$db->rollBack();
		return FALSE;
	}
}

function zurron_cambiarEmail($email,$user_id){ // Sentecia para mostrar todos los mensajes de un ususario pero se devuleve un array con las lineas
	$res = load_config(dirname(__FILE__)."/configuration.xml", dirname(__FILE__)."/configuration.xsd");
	$db = new PDO($res[0], $res[1], $res[2]);
	$db->beginTransaction();
	$ins = "UPDATE users SET users.email='$email' WHERE users.id=$user_id;";
	$resul = $db->query($ins);	
	if($resul->rowCount() ==1){		
		$db->commit();
		return TRUE;	
	}else{
		$db->rollBack();
		return FALSE;
	}
}

function zurron_cambiarDireccion($direccion,$user_id){ // Sentecia para mostrar todos los mensajes de un ususario pero se devuleve un array con las lineas
	$res = load_config(dirname(__FILE__)."/configuration.xml", dirname(__FILE__)."/configuration.xsd");
	$db = new PDO($res[0], $res[1], $res[2]);
	$db->beginTransaction();
	$ins = "UPDATE users SET users.direccion='$direccion' WHERE users.id=$user_id;";
	$resul = $db->query($ins);	
	if($resul->rowCount() ==1){		
		$db->commit();
		return TRUE;	
	}else{
		$db->rollBack();
		return FALSE;
	}
}

function zurron_cambiarAge($age,$user_id){ // Sentecia para mostrar todos los mensajes de un ususario pero se devuleve un array con las lineas
	$res = load_config(dirname(__FILE__)."/configuration.xml", dirname(__FILE__)."/configuration.xsd");
	$db = new PDO($res[0], $res[1], $res[2]);
	$db->beginTransaction();
	$ins = "UPDATE users SET users.age=$age WHERE users.id=$user_id;";
	$resul = $db->query($ins);	
	if($resul->rowCount() ==1){		
		$db->commit();
		return TRUE;	
	}else{
		$db->rollBack();
		return FALSE;
	}
}

function zurron_cambiarPfp($pfp,$user_id){ // Sentecia para mostrar todos los mensajes de un ususario pero se devuleve un array con las lineas
	$res = load_config(dirname(__FILE__)."/configuration.xml", dirname(__FILE__)."/configuration.xsd");
	$db = new PDO($res[0], $res[1], $res[2]);
	$db->beginTransaction();
	$ins = "UPDATE users SET users.pfp=$pfp WHERE users.id=$user_id;";
	$resul = $db->query($ins);	
	if($resul->rowCount() ==1){		
		$db->commit();
		return TRUE;	
	}else{
		$db->rollBack();
		return FALSE;
	}
}
// #######################################################################################
