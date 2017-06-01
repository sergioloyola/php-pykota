<?php
function historial($autor,$accion,$user,$conexion)
{
	$insertar = mysql_query("INSERT INTO historial (autor, accion, usuario) VALUES ('$autor','$accion','$user')",$conexion);
}
?>
