<?php
session_start(); // Starting Session
include('config/config.php');
$error=''; // Variable To Store Error Message
if (isset($_POST['submit'])) {
if (empty($_POST['username']) || empty($_POST['correo'])) {
$error = "Usuario o Correo Invalidos";
}
else
{
$username=$_POST['username'];
$correo=$_POST['correo'];
$password=$_POST['password'];
$checkpassword=$_POST['checkpassword'];
$username = stripslashes($username);
$correo = stripslashes($correo);
$password = stripslashes($password);
$checkpassword = stripslashes($checkpassword);
$username = mysql_real_escape_string($username);
$correo = mysql_real_escape_string($correo);
$password = mysql_real_escape_string($password);
$checkpassword = mysql_real_escape_string($checkpassword);
$password = md5($password);
$checkpassword = md5($checkpassword);

$resultado = mysql_query("select * from login where usuario='$username'", $conexion);
$usuario = mysql_fetch_row($resultado);
if ($correo == $usuario[4] &&  $password ==""){
	echo "<script type='text/javascript'>alert('No hay nada para actualizar!')</script>";
}elseif ($correo != $usuario[4]) {
	mysql_query("update login set email='$correo' where usuario='$username'", $conexion);
	echo "<script type='text/javascript'>alert('El correo fue actualizado con Exito!')</script>";
}elseif ($password != "" && $password == $checkpassword){
        mysql_query("update login set password='$password' where usuario='$username'", $conexion);
        echo "<script type='text/javascript'>alert('La contraseña fue actualizada!')</script>";
}else{
        echo "<script type='text/javascript'>alert('Las contraseñas ingresadas no coinciden!')</script>";
}
mysql_close($conexion); // Closing Connection
}
}
?>

