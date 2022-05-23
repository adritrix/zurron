<?php
function check_session(){
	session_start();
	if(!isset($_SESSION['id'])){	
		header("Location: index.php?redirected=true");
		exit;
	}		
}

