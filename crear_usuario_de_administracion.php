<?php
session_start(); // Starting Session
include('config/config.php');
include('config/funciones.php');
$error=''; // Variable To Store Error Message
$emailErr='';
if (isset($_POST['submit'])) {
if (empty($_POST['username']) || empty($_POST['password'])) {
$error = "Usuario o contraseña Invalidos";
}
else
{
// Define $username and $password
$username=$_POST['username'];
$password=$_POST['password'];
$email = $_POST['correo'];
$perfilname=$_POST['perfilname'];
$groupname=$_POST['groupname'];
$login=$_POST['login'];
$username = stripslashes($username);
$password = stripslashes($password);
$email = stripslashes($email);
$perfilname = stripslashes($perfilname);
$groupname = stripslashes($groupname);

$username = mysql_real_escape_string($username);
$password = mysql_real_escape_string($password);
$email = mysql_real_escape_string($email);
$perfilname = mysql_real_escape_string($perfilname);
$groupname = mysql_real_escape_string($groupname);
$resultado_id_perfil = mysql_query("select id from perfiles where perfil='$perfilname'", $conexion);
$perfil = mysql_fetch_row($resultado_id_perfil);
$idperfil = $perfil[0];
if ($perfilname == "administrador")
{
	$idgroup="1";
}else{
	$resultado_id_group = mysql_query("select id from groups where groupname='$groupname'", $conexion);
	$group = mysql_fetch_row($resultado_id_group);
	$idgroup = $group[0];
}
$query = mysql_query("select * from login where usuario='$username'", $conexion);
$rows = mysql_num_rows($query);
if ($rows == 1) {
$error = "El usuario ya Existe";

} else {
if($idgroup == "1")
{
	historial($login,"El usuario fue creado con el perfil: ".$perfilname,$username,$conexion);
}else{
	historial($login,"El usuario fue creado con el perfil: ".$perfilname." y grupo ".$groupname,$username,$conexion);
}
mysql_query("insert into login (usuario, password, perfil, email, idgroup) VALUES('$username', '$password', '$idperfil', '$email', '$idgroup')", $conexion);
echo "<script type='text/javascript'>alert('El usuario se creo con exito!!!')</script>";
}
mysql_close($conexion); // Closing Connection
}
}
?>
