<?php
session_start(); // Starting Session
include('config/config.php');
include('config/funciones.php');
$error=''; // Variable To Store Error Message
if (isset($_POST['submit'])) {
if (empty($_POST['username']) || empty($_POST['correo'])) {
$error = "Usuario o Correo Invalidos";
}
else
{
$username=$_POST['username'];
$correo=$_POST['correo'];
$descripcion=$_POST['descripcion'];
$login=$_POST['login'];
$username = stripslashes($username);
$correo = stripslashes($correo);
$password = stripslashes($descripcion);
$username = mysql_real_escape_string($username);
$correo = mysql_real_escape_string($correo);
$descripcion = mysql_real_escape_string($descripcion);
historial($login,"Modificacion de usuario",$username,$conexion);

//die($username);
mysql_query("update users set email='$correo', description='$descripcion' where username='$username'", $conexion);
echo "<script type='text/javascript'>alert('El usuario fue actualizado!')</script>";
//mysql_close($conexion); // Closing Connection
}
}
?>

