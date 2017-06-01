<html>
<head>
</head>
<body>

<?php
include('config/config.php');
include('config/funciones.php');
session_start(); // Starting Session
$error=''; // Variable To Store Error Message
if (isset($_POST['submit'])) {
if (empty($_POST['username']) || empty($_POST['password'])) {
$error = "Username or Password is invalid";
}
else
{
// Define $username and $password
$username=$_POST['username'];
$password=$_POST['password'];
$username = stripslashes($username);
$password = stripslashes($password);
$username = mysql_real_escape_string($username);
$password = mysql_real_escape_string($password);
$query = mysql_query("select * from login where password='$password' AND usuario='$username'", $conexion);
$rows = mysql_num_rows($query);
if ($rows == 1) {

$consultarol=mysql_query("select perfil from login where password='$password' AND usuario='$username'", $conexion);
$result = mysql_fetch_array($consultarol);
$rol=$result['perfil'];
$_SESSION['login_user']=$username; // Initializing Session
$_SESSION['login_rol']=$rol; // Initializing Session
historial("SyStem","El usuario a ingresado al sistema",$username,$conexion);
header("location: profile.php"); // Redirecting To Other Page
} else {
$error = "Usuario o contraseña invalidos";
//echo "<center>Usuario o contraseña invalidos</center>";
}
mysql_close($conexion); // Closing Connection
}
}
?>
</body>
</html>
