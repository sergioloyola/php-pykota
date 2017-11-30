<?php

/* database connection details
 ******************************/
$servidor  = "localhost";
$usuario   = "root";
$clave     = "123456";
$basedatos = "pykota";
$conexion=mysql_connect ($servidor, $usuario, $clave) or die ('problema conectando porque :' . mysql_error());
mysql_select_db($basedatos, $conexion); 
$estilo = "template/kion/style.css";
$estilo_pass = "../template/kion/style.css";
$estilo_login = "template/kion/login.css";
?>
