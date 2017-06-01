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
	mysql_select_db($basedatos, $conexion); 
	$result = mysql_query("SELECT printername, description, priceperpage, priceperjob, maxjobsize FROM printers", $conexion); 
	echo "<div class=\"panel panel-default\">";
	echo "<div class=\"panel-heading\"><center><b>Impresoras del Sistema</b></center></div>";
	echo "<table class=\"table\">";
	echo "<tr><th>Impresora</th><th>Descripcion</th><th>Precio x Pagina</th><th>Precio x Trabajo</th><th>Tamaño maximo</th></tr> \n"; 
	while ($row = mysql_fetch_row($result)){ 
		echo "<tr><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td><td>$row[4]</td></tr> \n"; 
	} 
	echo "</table> \n"; 
	echo "</div>";
	echo "</div>";
	?> 
	<?php include "template/default/footer.inc"; ?>
</body> 
</html> 

