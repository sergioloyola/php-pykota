<?php
session_start(); // Starting Session
include('config/config.php');
include('config/funciones.php');
$error=''; // Variable To Store Error Message
if (isset($_POST['submit'])) {
	if (empty($_POST['username']) || empty($_POST['softlimit'])) {
		$error = "Usuario o Correo Invalidos";
	}
	else
	{
		$username=$_POST['username'];
		$softlimit=$_POST['softlimit'];
		$hardlimit=$_POST['hardlimit'];
		$printername=$_POST['printername'];
		$login=$_POST['login'];
		$username = stripslashes($username);
		$softlimit = stripslashes($softlimit);
		$hardlimit = stripslashes($hardlimit);
		$printername = stripslashes($printername);
		$username = mysql_real_escape_string($username);
		$softlimit = mysql_real_escape_string($softlimit);
		$hardlimit = mysql_real_escape_string($hardlimit);
		$printername = mysql_real_escape_string($printername);

		$resultado = mysql_query("select id from users where username='$username'", $conexion);
		$idusuario = mysql_fetch_row($resultado);
		$resul_print = mysql_query("select id from printers where printername='$printername'", $conexion);
		$id_printer = mysql_fetch_row($resul_print);
		$printerid = $id_printer[0];
		$userid = $idusuario[0];
		$lifepagecounter = "0";
		$pagecounter = "0";
		$softlimit = $softlimit;
		$hardlimit = $hardlimit;
		$datelimit = "";
		$maxjobsize = "";
		$warncount = "0";

		$query = mysql_query("select * from userpquota where userid='$userid' and printerid ='$printerid'", $conexion);
		$rows = mysql_num_rows($query);
		if ($rows == 1) {
			historial($login,"Actualizacion de cuota, softlimit: ".$softlimit." y hardlimit: ".$hardlimit." en la impresora: ".$printername,$username,$conexion);
			mysql_query("update userpquota set softlimit='$softlimit', hardlimit='$hardlimit' where userid='$userid'", $conexion);
			echo "<script type='text/javascript'>alert('La Cuota fue Actualizada con Exito!')</script>";
		} else {
			historial($login,"Asignacion de cuota, softlimit: ".$softlimit." y hardlimit: ".$hardlimit." en la impresora: ".$printername,$username,$conexion);
			mysql_query("insert into userpquota (userid, printerid, lifepagecounter, pagecounter, softlimit, hardlimit,  warncount) VALUES('$userid', '$printerid', '$lifepagecounter', '$pagecounter', '$softlimit', '$hardlimit', '$warncount')", $conexion);
			echo "<script type='text/javascript'>alert('Asignación de Cuota, Exitosa!')</script>";
		}
	mysql_close($conexion); // Closing Connection
	}
}
?>

