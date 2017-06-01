<?php
//header('Content-type: application/vnd.ms-excel;charset=utf-8');
//header("Content-Disposition: attachment; filename=oportunidad.xls");
//header("Pragma: no-cache");
//header("Expires: 0");
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
$username=$_POST['username'];
$username = stripslashes($username);
$resul_print = mysql_query("select id from users where username='$username'", $conexion);
$userid = mysql_fetch_row($resul_print);
$id_user = $userid[0];
$result = mysql_query("SELECT printerid, pagecounter, softlimit, hardlimit FROM userpquota WHERE userid='$id_user'", $conexion); 
echo "<table border = '1'> \n"; 
echo "<tr><th>Usuario</th><th>Hojas Impresas</th><th>SoftLimit</th><th>HardLimit</th></tr> \n"; 
while ($row = mysql_fetch_row($result)){
       $resul_user = mysql_query("select printername from printers where id='$row[0]'", $conexion);
       $printername = mysql_fetch_row($resul_user); 
       $nombre = $printername[0];
       $total_impresiones=$total_impresiones + $row[1];
       echo "<tr><td>$nombre</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td></tr> \n"; 
} 
echo "</table> \n";
echo "<br>";
echo "<p>Total de Impresiones: ".$total_impresiones."</p>";

}
?>

