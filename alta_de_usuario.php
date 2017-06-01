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
		// Define $username and $password
		$username=$_POST['username'];
		$correo=$_POST['correo'];
		$login=$_POST['login'];
		historial($login,"Creacion de usuario",$username,$conexion);
		$username = stripslashes($username);
		$correo = stripslashes($correo);
		$username = mysql_real_escape_string($username);
		$correo = mysql_real_escape_string($correo);
		$limitby = "quota";
		$description = "prueba";
		$overcharge = "1";
		$level = "usuario";
		$balance = "0";
		$lifetimepaid = "0";
		$query = mysql_query("select * from users where username='$username'", $conexion);
		$rows = mysql_num_rows($query);
		if ($rows == 1) {
			$error = "El usuario ya Existe";

		} else {
			mysql_query("insert into users (username, email, balance, lifetimepaid, limitby, description, overcharge, level) VALUES('$username','$correo','$balance','$lifetimepaid','$limitby','$description','$overcharge','$level')", $conexion);
			?>
			<script type="text/javascript">
			alert("La creacion del usuario <?php echo $username; ?> fue exitosa!!!.");
			location.href='crear_grupo.php?' + Math.random();
			</script>
			<?php
	        }
		mysql_close($conexion); // Closing Connection
	}
}
?>

