
<html>
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title>Listado de Impresiones</title>
<?php
echo "<link href=\"$estilo\" rel=stylesheet type=text/css>";
?>
</head>
<body>
<?php
include('config/config.php');
$dia=date('d_m_Y');
header("Content-type: application/vnd.ms-excel; name='excel'");
header("Content-Disposition: attachment; filename=reporte_$fecha.xls");
header('Pragma: public');
header('Cache-Control: no-store, no-cache, must-revalidate'); // HTTP/1.1 
header('Cache-Control: pre-check=0, post-check=0, max-age=0'); // HTTP/1.1 
header('Pragma: no-cache');
header('Expires: 0');
header('Content-Transfer-Encoding: none');
header('Content-type: application/vnd.ms-excel; charset=UTF-8');// This should work for IE & Opera 
header('Content-type: application/x-msexcel; charset=UTF-8'); // This should work for the rest 
header("Content-Disposition: attachment; filename=reporte_$dia.xls");
header("Content-Type: application/force-download");
header("Content-Type: application/octet-stream");

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
//die($printername);
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
echo "<table border = '1' id = 'excel'> \n"; 
echo "<tr><th>Usuario</th><th>Hojas Impresas</th><th>Precio</th><th>titulo</th></tr> \n"; 
while ($row = mysql_fetch_row($result)){
       $resul_user = mysql_query("select username from users where id='$row[0]'", $conexion);
       $username = mysql_fetch_row($resul_user); 
       $nombre = $username[0];
       $total_impresiones=$total_impresiones + $row[1];
       echo "<tr><td>$nombre</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td></tr> \n"; 
} 
echo "</table> \n";
echo "<br>";
echo "<p>Total de Impresiones: ".$total_impresiones."</p>";
}
//else if ($printername == "Todas" and $mes != "anual"){
if ($printername != "Todas" and $mes != "anual"){
$resul_print = mysql_query("select id from printers where printername='$printername'", $conexion);
$printerid = mysql_fetch_row($resul_print);
$id_printer = $printerid[0];
$result = mysql_query("SELECT userid, jobsize, jobprice, title FROM jobhistory WHERE Year(jobdate)=$year and Month(jobdate)=$filter_mes and printerid=$id_printer", $conexion); 
echo "<table border = '1' id = 'excel'> \n"; 
echo "<tr><th>Usuario</th><th>Hojas Impresas</th><th>precio</th><th>titulo</th></tr> \n"; 
while ($row = mysql_fetch_row($result)){
       $resul_user = mysql_query("select username from users where id='$row[0]'", $conexion);
       $username = mysql_fetch_row($resul_user); 
       $nombre = $username[0];
       $total_impresiones=$total_impresiones + $row[1];
       echo "<tr><td>$nombre</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td></tr> \n";
} 
echo "</table> \n";
echo "<br>";
echo "<p>Total de Impresiones: ".$total_impresiones."</p>";
}
if ($printername == "Todas" and $mes != "anual"){
$result = mysql_query("SELECT userid, jobsize, jobprice, title FROM jobhistory WHERE Year(jobdate)=$year and Month(jobdate)=$filter_mes", $conexion); 
echo "<table border = '1' id= 'excel'> \n"; 
echo "<tr><th>Usuario</th><th>Hojas Impresas</th><th>precio</th><th>titulo</th></tr> \n"; 
while ($row = mysql_fetch_row($result)){
       $resul_user = mysql_query("select username from users where id='$row[0]'", $conexion);
       $username = mysql_fetch_row($resul_user); 
       $nombre = $username[0];
       $total_impresiones=$total_impresiones + $row[1];
       echo "<tr><td>$nombre</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td></tr> \n";
} 
echo "</table> \n";
echo "<br>";
echo "<p>Total de Impresiones: ".$total_impresiones."</p>";
}
}
}
?>
</body> 
</html> 

