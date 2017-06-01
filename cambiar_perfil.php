<?php
include('config/config.php');
include('session.php');
include('editar_perfil.php');
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
	<h2>Perfil Actual</h2>
	<form action="" method="post">
	<div class="form-group">
		<label>Usuario :</label>
		<?php
		$username=$_SESSION['login_user'];
		$resultado = mysql_query("select * from login where usuario='$username'", $conexion);
		$idusuario = mysql_fetch_row($resultado);
		//die($idusuario[0]);
		?>
		<input class="form-control" id="name" name="username" value=<?php echo $idusuario[1]?> type="text" readonly>
	</div>
	<div class="form-group">
		<label>Correo :</label>
		<input class="form-control" id="name" name="correo" value=<?php echo $idusuario[4]?> type="text">
	</div>
	<div class="form-group">
		<label>Contraseña :</label>
		<input class="form-control" id="password" name="password" placeholder="contraseña" type="password">
	</div>
	<div class="form-group">
		<label>Repetir Contraseña :</label>
		<input class="form-control" id="checkpassword" name="checkpassword" placeholder="chequear contraseña" type="password">
	</div>
<button name ="submit" type="submit" class="btn btn-default">Cambiar</button>
	</form>
</div>
  <p><?php include "template/default/footer.inc"; ?></p> 
</body>
</html>

