
<html>
<head>
<title>Listado de Usuarios</title>
	<?php
	echo "<link href=\"$estilo\" rel=stylesheet type=text/css>";
	?>
</head>
<body>
<!-- Menu -->
<?php include "template/default/menu.inc"; ?>
<?php
session_start(); // Starting Session
include('config/config.php');
include('config/funciones.php');
$total_impresiones = "0";
$error=''; // Variable To Store Error Message
if (isset($_POST['submit'])) {
if (empty($_POST['username'])) {
$error = "Seleccione un usuario";
}
else
{
// Define $username and $password
$username=$_POST['username'];
$username = stripslashes($username);
$groupname=$_POST['groupname'];
$login=$_POST['login'];
$groupname = stripslashes($groupname);
historial($login,"Se asocio el usuario: ".$username,$groupname,$conexion);
$resul_userid = mysql_query("select id from users where username='$username'", $conexion);
$userid = mysql_fetch_row($resul_userid);
$id_user = $userid[0];
$resul_groupid = mysql_query("select id from groups where groupname='$groupname'", $conexion);
$groupid = mysql_fetch_row($resul_groupid);
$id_group = $groupid[0];
//die ($id_group);
mysql_query("insert into groupsmembers (groupid, userid) VALUES('$id_group', '$id_user')", $conexion);
//mysql_close($connection); // Closing Connection
}
}
?>
<script type="text/javascript">
    alert("El usuario <?php echo $username; ?> Fue asociado al grupo <?php echo $groupname; ?> con exito!!!.");
    //history.back();
     location.href='asignar_usuario_a_grupo.php?' + Math.random();
</script>
 
</body> 
</html> 

