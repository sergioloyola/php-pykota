<?php
include('session.php');
include('config/config.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Php-Pykota</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
	<link href="style/style_bootstrap.css" rel="stylesheet" type="text/css">
	<?php
	echo "<link href=\"$estilo\" rel=stylesheet type=text/css>";
	?>
</head>
<body>
<!-- Menu -->
<?php include "template/default/menu.inc"; ?>
<div class="container">
<h2>Cantidad de Impresiones</h2>
<form action="reporte_impresiones_por_usuario.php" method="post">
<div class="form-group">
<label>Usuario :</label>
<?php
echo"<select class=\"form-control\" name=username id=username>";

$user= $_SESSION['login_user'];
$result_idgroup = mysql_query("SELECT idgroup from login where usuario='$user'",$conexion);
$idgroup = mysql_fetch_row($result_idgroup);
//die($idgroup[0]);
if ($user == "administrador")
{
	$sql="SELECT username FROM users";
	$result=mysql_query($sql);
	$i=0;
	while ($row=mysql_fetch_row($result))
	{
		echo "<option value=".$row[$i].">".$row[$i]."</option>\n";
	}
	echo "</select>";
}else{
$result_userid = mysql_query("select userid from groupsmembers where groupid='$idgroup[0]'", $conexion);
$i=0;
while ($userid = mysql_fetch_row($result_userid)){
	$result = mysql_query("SELECT username FROM users where id='$userid[0]'", $conexion); 
	while ($row=mysql_fetch_row($result))
        {
                echo "<option value=".$row[$i].">".$row[$i]."</option>\n";
        }
}
        echo "</select>";
	mysql_close($conexion); // Closing Connection

}

?>
</div>
<button name ="submit" type="submit" class="btn btn-default">Listar</button>
<span><?php echo $error; ?></span>
</form>
</div>
<?php include "template/default/footer.inc"; ?>
</body>
</html>

