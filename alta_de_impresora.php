<?php
session_start(); // Starting Session
include('config/config.php');
include('config/funciones.php');
$error=''; // Variable To Store Error Message
if (isset($_POST['submit'])) {
if (empty($_POST['printname']) || empty($_POST['descripcion'])) {
$error = "Nombre de Impresora o Descripcion Invalidos";
}
else
{
// Define $username and $password
$printname=$_POST['printname'];
$descripcion=$_POST['descripcion'];
$login=$_POST['login'];
// Establishing Connection with Server by passing server_name, user_id and password as a parameter
//$connection = mysql_connect("localhost", "root", "dsiredes");
// To protect MySQL injection for Security purpose
$printname = stripslashes($printname);
$descripcion = stripslashes($descripcion);
$printname = mysql_real_escape_string($printname);
$descripcion = mysql_real_escape_string($descripcion);
$priceperpage = "0.5";
$priceperjob = "0";
$passthrough = "f";
$maxjobsize = "0";
// Selecting Database
//$db = mysql_select_db("pykota", $connection);
// SQL query to fetch information of registerd users and finds user match.
          //          ("select * from login where password='$password' AND usuario='$username'"
$query = mysql_query("select * from printers where printername='$printname'", $conexion);
$rows = mysql_num_rows($query);
if ($rows == 1) {
//$_SESSION['login_user']=$username; // Initializing Session
//header("location: profile.php"); // Redirecting To Other Page
$error = "El usuario ya Existe";

} else {
historial($login,"Se agrego una nueva impresora",$printname,$conexion);
mysql_query("insert into printers (printername, description, priceperpage, priceperjob, passthrough, maxjobsize) VALUES('$printname','$descripcion','$priceperpage','$priceperjob','$passthrough','$maxjobsize')", $conexion);
echo "<script type='text/javascript'>alert('La impresora se creo con exito!!!')</script>";
}
mysql_close($connection); // Closing Connection
}
}
?>

