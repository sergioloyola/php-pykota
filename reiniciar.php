<?php
include('config/config.php');
include('config/funciones.php');
session_start();
if (isset($_POST['reiniciar_usuario'])) {
	$username=$_POST['username'];
	$tipo=$_POST['variable'];
	$login=$_POST['login'];
	$username = stripslashes($username);
	historial($login,"reinicio de contadores",$username,$conexion);
	reiniciar_usuario($username,$conexion);
}
if (isset($_POST['reiniciar_todo'])) {
	$groupname=$_POST['username'];
	$tipo=$_POST['variable'];
	$login=$_POST['login'];
	$groupname = stripslashes($groupname);
	$tipo = stripslashes($tipo);
	backup('localhost','root','dsiredes','pykota');
	if ($tipo == "usuario"){
		if ($groupname == "Todos"){
			reiniciar_todos_los_contadores($conexion);
			historial($login,"reinicio de todos los contadores","Todos",$conexion);
		}else{
			reiniciar_usuario($groupname,$conexion);
			historial($login,"reinicio de contadores",$groupname,$conexion);

		}
	}else{
		reiniciar_todos_los_contadores_grupos($groupname,$conexion);
		historial($login,"reinicio de todos los contadores del grupo",$groupname,$conexion);

	}
}
function backup($host,$user,$pass,$name) //Deja el backup en la carpeta data
{ 
	$dbFile = 'pykota-'.date('Y-m-d-H-i-s').'.sql.gz';
	exec( 'mysqldump --host="'.$host.'" --user="'.$user.'" --password="'.$pass.'" --add-drop-table "'.$name.'" | gzip > "data/'.$dbFile.'"' );
}      
function reiniciar_usuario($username,$conexion)
{
	$resul_print = mysql_query("select id from users where username='$username'", $conexion);
	$userid = mysql_fetch_row($resul_print);
	$id_user = $userid[0];
	$result = mysql_query("update userpquota set pagecounter='0', lifepagecounter='0' WHERE userid='$id_user'", $conexion); 
	echo"<script> alert('El reinicio de los contadores, se realizo con exito!!!')</script>";

}
function reiniciar_todos_los_contadores($conexion)
{
	$result = mysql_query("update userpquota set pagecounter='0', lifepagecounter='0'", $conexion); 
	echo"<script> alert('El reinicio de contadores, se realizo con exito!!!')</script>";

}
function reiniciar_todos_los_contadores_grupos($groupname,$conexion)
{
	$resul_group = mysql_query("select id from groups where groupname='$groupname'", $conexion);
	$groupid = mysql_fetch_row($resul_group);
	$id_group = $groupid[0];
	$sql="select userid from groupsmembers where groupid='$id_group'";
	$result=mysql_query($sql);
	$i=0;
	while ($row=mysql_fetch_row($result))
	{
		$id_user=$row[0];
		$resultado = mysql_query("update userpquota set pagecounter='0', lifepagecounter='0' where userid='$id_user'", $conexion); 
		unset($id_user);
	}
	echo"<script> alert('El respaldo y reinicio de contadores, se realizo con exito!!!')</script>";
}

?>


