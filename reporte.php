<html>
<head>
<title>Listado de Usuarios</title>
<?php
echo "<link href=\"$estilo\" rel=stylesheet type=text/css>";
?>
</head>
<body>
	<img border="0" src="images/flechaVolverIz.png" width="200" height="30" onClick="javascript:history.back()">
<?php
session_start(); // Starting Session
$error=''; // Variable To Store Error Message
if (isset($_POST['submit'])) {
if (empty($_POST['printername'])) {
$error = "Seleccione una impresora";
}
else
{
// Define $username and $password
$printername=$_POST['printername'];
$printername = stripslashes($printername);
$servidor     = "localhost";
$usuario      = "root";
$clave          = "123456";
$basedatos = "pykota";
$conexion=mysql_connect ($servidor, $usuario, $clave) or die ('problema conectando porque :' . mysql_error());
mysql_select_db($basedatos, $conexion); 
if ($printername == "default"){
$result = mysql_query("SELECT userid, pagecounter, softlimit, hardlimit FROM userpquota", $conexion); 
echo "<table border = '1'> \n"; 
echo "<tr><th>Usuario</th><th>Hojas Impresas</th><th>SoftLimit</th><th>HardLimit</th></tr> \n"; 
while ($row = mysql_fetch_row($result)){
       $resul_user = mysql_query("select username from users where id='$row[0]'", $conexion);
       $username = mysql_fetch_row($resul_user); 
       $nombre = $username[0];
       echo "<tr><td>$nombre</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td></tr> \n"; 
} 
echo "</table> \n";
}
else
{
$resul_print = mysql_query("select id from printers where printername='$printername'", $conexion);
$printerid = mysql_fetch_row($resul_print);
$id_printer = $printerid[0];
$result = mysql_query("SELECT userid, pagecounter, softlimit, hardlimit FROM userpquota WHERE printerid='$id_printer'", $conexion); 
echo "<table border = '1'> \n"; 
echo "<tr><th>Usuario</th><th>Hojas Impresas</th><th>SoftLimit</th><th>HardLimit</th></tr> \n"; 
while ($row = mysql_fetch_row($result)){
       $resul_user = mysql_query("select username from users where id='$row[0]'", $conexion);
       $username = mysql_fetch_row($resul_user); 
       $nombre = $username[0];
       echo "<tr><td>$nombre</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td></tr> \n"; 
} 
echo "</table> \n";
}
}
}
?> 
  
</body> 
</html> 

