<?php
session_start(); // Starting Session
include('config/config.php');
include('config/funciones.php');
$error=''; // Variable To Store Error Message
if (isset($_POST['submit'])) {
if (empty($_POST['groupname']) || empty($_POST['descripcion'])) {
$error = "Nombre de Grupo o Descripcion Invalidos";
}
else
{
// Define $username and $password
$groupname=$_POST['groupname'];
$descripcion=$_POST['descripcion'];
$login=$_POST['login'];
$groupname = stripslashes($groupname);
$descripcion = stripslashes($descripcion);
$groupname = mysql_real_escape_string($groupname);
$descripcion = mysql_real_escape_string($descripcion);
$limitby = "quota";
historial($login,"Creacion de grupo",$groupname,$conexion);
$query = mysql_query("select * from groups where groupname='$groupname'", $conexion);
$rows = mysql_num_rows($query);
if ($rows == 1) {
$error = "El grupo ya Existe";
} else {
mysql_query("insert into groups (groupname, description, limitby) VALUES('$groupname','$descripcion','$limitby')", $conexion);
?>
<script type="text/javascript">
    alert("El grupo <?php echo $groupname; ?> fue dado de alta con exito!!!.");
    //history.back();
     location.href='crear_grupo.php?' + Math.random();
</script>
<?php
}
mysql_close($conexion); // Closing Connection
}
}
?>

