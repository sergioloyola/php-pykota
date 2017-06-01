<?php
include('config/config.php');
include('session.php');
include('editar_usuario.php');
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
	<h2>Modificar Usuario</h2>
	<form action="" method="post">
	<div class="form-group">
		<label>Usuario :</label>
		<?php
		echo"<select class=\"form-control\" name=username id=name>";
                $sql="SELECT username FROM users";
                $result=mysql_query($sql);
                $i=0;
                while ($row=mysql_fetch_row($result))
                {
                	echo "<option value=".$row[$i].">".$row[$i]."</option>\n";
              	}
              	echo "</select>";
	      	mysql_close($conexion); // Closing Connection
	        ?>
	</div>
	<div class="form-group">
		<label>Correo :</label>
		<input class="form-control" id="correo" name="correo" placeholder="correo" type="text">
	</div>
	<div class="form-group">
		<label>Descripcion :</label>
		<input class="form-control" id="descripcion" name="descripcion" placeholder="descripcion" type="text">
	</div>
		<?php
			$user= $_SESSION['login_user'];
			echo "<input type=\"hidden\" name=login value=\"$user\" />";
		?>
		<button name ="submit" type="submit" class="btn btn-default">Modificar</button>
	</form>
</div>
  <p><?php include "template/default/footer.inc"; ?></p> 
</body>
</html>

