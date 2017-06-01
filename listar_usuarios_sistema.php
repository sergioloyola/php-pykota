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
	//$result_idgroup = mysql_query("SELECT idgroup from login where usuario='guadalupe'",$conexion);
	$user= $_SESSION['login_user'];
	if ($user == "administrador")
	{
		$result = mysql_query("SELECT usuario, perfil, email FROM login", $conexion); 
		//echo "<center><table border = '1'> \n</center>"; 
		echo "<div class=\"panel panel-default\">";
		echo "<div class=\"panel-heading\"><center><b>Lista de Usuarios</b></center></div>";
		echo "<table class=\"table\">"; 
		echo "<tr><th>Usuario</th><th>Perfil</th><th>e-mail</th></tr> \n"; 
		while ($row = mysql_fetch_row($result)){ 
		       echo "<tr><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td></tr> \n"; 
		} 
		echo "</table> \n";
		echo "</div>";
		echo "</div>";
	}
	?> 
	<?php include "template/default/footer.inc"; ?>
</body> 
</html> 

