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
if (empty($_POST['printername'])) {
$error = "Seleccione una impresora";
}
else
{
// Define $username and $password
$printername=$_POST['printername'];
$printername = stripslashes($printername);
$mes=$_POST['mes'];
$mes = stripslashes($mes);
$year=$_POST['year'];
$year = stripslashes($year);
//die($year);
switch ($mes) {
    case "enero":
        $filter_mes=1;
        break;
    case "febrero":
        $filter_mes=2;
        break;
    case "marzo":
        $filter_mes=3;
        break;
    case "abril":
        $filter_mes=4;
        break;
    case "mayo":
        $filter_mes=5;
        break;
    case "junio":
        $filter_mes=6;
        break;
    case "julio":
        $filter_mes=7;
        break;
    case "agosto":
        $filter_mes=8;
        break;
    case "septiembre":
        $filter_mes=9;
        break;
    case "octubre":
        $filter_mes=10;
        break;
    case "noviembre":
        $filter_mes=11;
        break;
    case "diciembre":
        $filter_mes=12;
        break;
}
mysql_query("SET NAMES 'utf8'");
if ($printername == "Todas" and $mes == "anual"){
$result = mysql_query("SELECT userid, jobsize, jobprice, title FROM jobhistory WHERE Year(jobdate)=$year", $conexion); 
echo "<div class=\"panel panel-default\">";
echo "<div class=\"panel-heading\"><center><b>Lista de Usuarios</b></center></div>";
echo "<table class=\"table\">"; 
echo "<tr><th>Usuario</th><th>Hojas Impresas</th><th>Precio</th><th>titulo</th></tr> \n"; 
while ($row = mysql_fetch_row($result)){
       $resul_user = mysql_query("select username from users where id='$row[0]'", $conexion);
       $username = mysql_fetch_row($resul_user); 
       $nombre = $username[0];
       $total_impresiones=$total_impresiones + $row[1];
       echo "<tr><td>$nombre</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td></tr> \n"; 
} 
echo "</table> \n";
echo "</div>";
echo "</div>";
echo "<br>";
echo "<p>Total de Impresiones: ".$total_impresiones."</p>";
}
//else if ($printername == "Todas" and $mes != "anual"){
if ($printername != "Todas" and $mes != "anual"){
$resul_print = mysql_query("select id from printers where printername='$printername'", $conexion);
$printerid = mysql_fetch_row($resul_print);
$id_printer = $printerid[0];
$result = mysql_query("SELECT userid, jobsize, jobprice, title FROM jobhistory WHERE Year(jobdate)=$year and Month(jobdate)=$filter_mes and printerid=$id_printer", $conexion); 
echo "<div class=\"panel panel-default\">";
echo "<div class=\"panel-heading\"><center><b>Lista de Usuarios</b></center></div>";
echo "<table class=\"table\">"; 
echo "<tr><th>Usuario</th><th>Hojas Impresas</th><th>precio</th><th>titulo</th></tr> \n"; 
while ($row = mysql_fetch_row($result)){
       $resul_user = mysql_query("select username from users where id='$row[0]'", $conexion);
       $username = mysql_fetch_row($resul_user); 
       $nombre = $username[0];
       $total_impresiones=$total_impresiones + $row[1];
       echo "<tr><td>$nombre</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td></tr> \n";
} 
echo "</table> \n";
echo "</div>";
echo "</div>";
echo "<br>";
echo "<p>Total de Impresiones: ".$total_impresiones."</p>";
}
if ($printername == "Todas" and $mes != "anual"){
$result = mysql_query("SELECT userid, jobsize, jobprice, title FROM jobhistory WHERE Year(jobdate)=$year and Month(jobdate)=$filter_mes", $conexion); 
echo "<div class=\"panel panel-default\">";
echo "<div class=\"panel-heading\"><center><b>Lista de Usuarios</b></center></div>";
echo "<table class=\"table\">"; 
echo "<tr><th>Usuario</th><th>Hojas Impresas</th><th>precio</th><th>titulo</th></tr> \n"; 
while ($row = mysql_fetch_row($result)){
       $resul_user = mysql_query("select username from users where id='$row[0]'", $conexion);
       $username = mysql_fetch_row($resul_user); 
       $nombre = $username[0];
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
}
?>
<form action="exportar_a_excel.php" method="post">
 <input type="hidden" name="printername" value=<?php echo "".$printername."";?> />
 <input type="hidden" name="mes" value=<?php echo "".$mes."";?> />
 <input type="hidden" name="year" value=<?php echo "".$year."";?> />
 <button name ="submit" type="submit" class="btn btn-default">Exportar a Excel</button>
</form>
</body> 
</html> 

