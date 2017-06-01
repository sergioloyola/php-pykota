<?php
include('config/config.php');
include('config/funciones.php');

?>
<html>
<head>
<title>Listado de Usuarios</title>
	<?php
	echo "<link href=\"$estilo\" rel=stylesheet type=text/css>";
	?>
</head>
<body>
<?php
session_start(); // Starting Session
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
$login=$_POST['login'];
historial($login,"Se elimino usuario",$username,$conexion);
$resul_print = mysql_query("select id from users where username='$username'", $conexion);
$userid = mysql_fetch_row($resul_print);
$id_user = $userid[0];
$result = mysql_query("DELETE FROM users WHERE id='$id_user'", $conexion); 
?>
<script type="text/javascript">
    alert("El usuario <?php echo $username; ?> fue eliminado!!!.");
    //history.back();
     location.href='eliminar_usuario.php?' + Math.random();
</script>

<?php
}
}
?> 
</body> 
</html> 

