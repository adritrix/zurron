<?php
require_once 'sessions.php';
require 'db.php';
check_session();
require 'header.php';
getHeader();

if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    zurron_cambiarNombre($_POST['name'],$_SESSION['id']);
    zurron_cambiarApellido($_POST['surname'],$_SESSION['id']);
    zurron_cambiarEmail($_POST['email'],$_SESSION['id']);
    zurron_cambiarDireccion($_POST['direccion'],$_SESSION['id']);
    zurron_cambiarAge($_POST['age'],$_SESSION['id']);
    if($_POST['pfp']!=null)
        zurron_cambiarPfp($_POST['pfp'],$_SESSION['id']);
    
    $userInfo=zurron_infoUser($_SESSION['nick']);
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

    header("Location: personalArea.php");


}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <title>Alter personal Area</title>
</head>
<body>
<form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method = "POST">
    <label for = "name">name</label> 
    <input value = "<?php if(isset($_SESSION['name']))echo $_SESSION['name'];?>"
    id = "name" name = "name" type = "text">
    <label for = "surname">surname</label> 
    <input value = "<?php if(isset($_SESSION['surname']))echo $_SESSION['surname'];?>"
    id = "surname" name = "surname" type = "surname">
    <label for = "email">email</label> 
    <input value = "<?php if(isset($_SESSION['email']))echo $_SESSION['email'];?>"
    id = "email" name = "email" type = "email">
    <label for = "direccion">direccion</label> 
    <input value = "<?php if(isset($_SESSION['direccion']))echo $_SESSION['direccion'];?>"
    id = "direccion" name = "direccion" type = "direccion">
    <label for = "direccion">age</label> 
    <input value = "<?php if(isset($_SESSION['age']))echo $_SESSION['age'];?>"
    id = "age" name = "age" type = "age">
    <div style='display:flex; flex-direction:row; flex-wrap: wrap; '>
        <img style='height:200px;' src='./Perfil1.png' alt='' style=''>
        <img style='height:200px;'  src='./Perfil2.png' alt='' style=''>
        <img style='height:200px;'  src='./Perfil3.png' alt='' style=''>
        <img style='height:200px;'  src='./Perfil4.png' alt='' style=''>
        <img style='height:200px;'  src='./Perfil5.png' alt='' style=''>
        <img style='height:200px;'  src='./Perfil6.png' alt='' style=''>
        <img style='height:200px;'  src='./Perfil7.png' alt='' style=''>
        <img style='height:200px;'  src='./Perfil8.png' alt='' style=''>
        <img style='height:200px;'  src='./Perfil9.png' alt='' style=''>
        <img style='height:200px;'  src='./Perfil10.png' alt='' style=''>
        <img style='height:200px;'  src='./Perfil11.png' alt='' style=''>
        <img style='height:200px;'  src='./Perfil12.png' alt='' style=''>
        <img style='height:200px;'  src='./Perfil13.png' alt='' style=''>
        <img style='height:200px;'  src='./Perfil14.png' alt='' style=''>
        <img style='height:200px;'  src='./Perfil99.png' alt='' style=''>
    </div>
    <label for = "pfp">ProfielPick</label> 
    <input list="pfp" name="pfp">
    <datalist id="pfp">
        <option value=1>
        <option value=2>
        <option value=3>
        <option value=4>
        <option value=5>
        <option value=6>
        <option value=7>
        <option value=8>
        <option value=9>
        <option value=10>
        <option value=11>
        <option value=12>
        <option value=13>
        <option value=14>
        <option value=99>
     </datalist>

    <br>				
    <input type = "submit" value="update">
    <br>
</form>

<a href='./logout.php'>Close sesion</a> <br>
<a href='./test.php'>Back to main page</a> <br>
    
</body>
</html>