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
	$result_idgroup = mysql_query("SELECT idgroup from login where usuario='$user'",$conexion);
	$idgroup = mysql_fetch_row($result_idgroup);
	if ($user == "administrador")
	{
		$result = mysql_query("SELECT username, email, balance, limitby, description FROM users", $conexion); 
		echo "<div class=\"panel panel-default\">";
		echo "<div class=\"panel-heading\"><center><b>Lista de Usuarios</b></center></div>";
		echo "<table class=\"table\">"; 
		echo "<tr><th>Usuario</th><th>E-Mail</th><th>Balance</th><th>Limitado por</th><th>Descripcion</th></tr> \n"; 
		while ($row = mysql_fetch_row($result)){ 
	 	       echo "<tr><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td><td>$row[4]</td></tr> \n"; 
		} 
	echo "</table> \n";
	echo "</div>";
	echo "</div>";
	}else{
		$result_userid = mysql_query("select userid from groupsmembers where groupid='$idgroup[0]'", $conexion);
		echo "<div class=\"panel panel-default\">";
		echo "<div class=\"panel-heading\"><center><b>Lista de Usuarios</b></center></div>";
		echo "<table class=\"table\">"; 
		echo "<tr><th>Usuario</th><th>E-Mail</th><th>Balance</th><th>Limitado por</th><th>Descripcion</th></tr> \n"; 
		while ($userid = mysql_fetch_row($result_userid)){
			$result = mysql_query("SELECT username, email, balance, limitby, description FROM users where id='$userid[0]'", $conexion); 
			$row = mysql_fetch_row($result);
		       echo "<tr><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td><td>$row[4]</td></tr> \n"; 
		}
	} 
	echo "</table> \n";
	echo "</div>";
	echo "</div>";
	?> 
	<?php include "template/default/footer.inc"; ?>
</body> 
</html> 

