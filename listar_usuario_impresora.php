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
</head>
<body>
<?php include "template/default/menu.inc"; ?>
<?php
//session_start(); // Starting Session
$error=''; // Variable To Store Error Message
if (isset($_POST['submit'])) {
//die($printername);

if (empty($_POST['printername'])) {
$error = "Seleccione una impresora";
}
else
{
// Define $username and $password
$printername=$_POST['printername'];
$printername = stripslashes($printername);
$resul_print = mysql_query("select id from printers where printername='$printername'", $conexion);
$printerid = mysql_fetch_row($resul_print);
$id_printer = $printerid[0];
$result = mysql_query("SELECT userid, pagecounter, softlimit, hardlimit FROM userpquota WHERE printerid='$id_printer'", $conexion); 
echo "<div class=\"panel panel-default\">";
echo "<div class=\"panel-heading\"><center><b>Usuarios por Impresora</b></center></div>";
echo "<table class=\"table\">";
echo "<tr><th>Usuario</th><th>Hojas Impresas</th><th>SoftLimit</th><th>HardLimit</th></tr> \n"; 
while ($row = mysql_fetch_row($result)){
       $resul_user = mysql_query("select username from users where id='$row[0]'", $conexion);
       $username = mysql_fetch_row($resul_user); 
       $nombre = $username[0];
       echo "<tr><td>$nombre</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td></tr> \n"; 
} 
echo "</table> \n";
echo "</div>";
echo "</div>";
}
}
?> 
<?php include "template/default/footer.inc"; ?>
</body> 
</html> 

