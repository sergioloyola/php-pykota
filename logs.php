<?php
include('session.php');
include('config/config.php');
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
	<?php
	$result = mysql_query("SELECT autor, accion, usuario, fecha FROM historial ORDER BY fecha DESC", $conexion); 
	echo "<div class=\"panel panel-default\">";
	echo "<div class=\"panel-heading\"><center><b>Lista de Usuarios</b></center></div>";
	echo "<table class=\"table\">"; 
	echo "<tr><th>Autor</th><th>Accion</th><th>Usuario</th><th>Fecha</th></tr> \n"; 
	while ($row = mysql_fetch_row($result)){ 
	       echo "<tr><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td></tr> \n"; 
	} 
	echo "</table> \n";
	echo "</div>";
	echo "</div>";
	?> 
	<?php include "template/default/footer.inc"; ?>
</body> 
</html> 

