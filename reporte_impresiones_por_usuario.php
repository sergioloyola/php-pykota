<?php
include('config/config.php');
include('session.php');
?>
<html>
<head>
        <title>Php-Pykota</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
	<link href="style/style_bootstrap.css" rel="stylesheet" type="text/css">
	<?php
	echo "<link href=\"$estilo\" rel=stylesheet type=text/css>";
	?>
</head>
<body>
	<!-- Menu -->
	<?php include "template/default/menu.inc"; ?>
	<?php include "template/default/footer.inc"; ?>
	<?php
	session_start(); // Starting Session
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
			mysql_select_db($basedatos, $conexion); 
			$resul_print = mysql_query("select id from users where username='$username'", $conexion);
			$userid = mysql_fetch_row($resul_print);
			$id_user = $userid[0];
			$result = mysql_query("SELECT printerid, pagecounter, softlimit, hardlimit FROM userpquota WHERE userid='$id_user'", $conexion); 
			echo "<div class=\"panel panel-default\">";
			echo "<div class=\"panel-heading\"><center><b>Lista de Usuarios</b></center></div>";
			echo "<table class=\"table\">"; 
			echo "<tr><th>Usuario</th><th>Hojas Impresas</th><th>SoftLimit</th><th>HardLimit</th></tr> \n"; 
			while ($row = mysql_fetch_row($result)){
			       $resul_user = mysql_query("select printername from printers where id='$row[0]'", $conexion);
		       	       $printername = mysql_fetch_row($resul_user); 
		       	       $nombre = $printername[0];
		               $total_impresiones=$total_impresiones + $row[1];
		               echo "<tr><td>$nombre</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td></tr> \n"; 
			} 
			echo "</table> \n";
			echo "</div>";
			echo "</div>";
			echo "<br>";
			echo "<p>Total de Impresiones: ".$total_impresiones."</p>";
		}
	}
	?>
	<form action="exportar_a_excel_por_usuario.php" method="post">
 	<input type="hidden" name="username" value=<?php echo "".$username."";?> />
 	<button name ="submit" type="submit" class="btn btn-default">Exportar a Excel</button>
	</form>
</body>
</html>

