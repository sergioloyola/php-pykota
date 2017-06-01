<?php
include('config/config.php');
include('session.php');
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
		<h2>Cuota de Impresion</h2>
		<form action="listar_usuario_impresora.php" method="post">
			<div class="form-group">
				<label for="impresora">Impresora :</label>
				<?php
				echo"<select class=\"form-control\" name=printername id=printername>";
				$sql="SELECT printername FROM printers";
				$result=mysql_query($sql);
				$i=0;
				while ($row=mysql_fetch_row($result))
				{
					echo "<option value=".$row[$i].">".$row[$i]."</option>\n";
				}
					echo "</select>";
					?>
					<!-- <input name="submit" type="submit" value=" Listar "> -->
			</div>
			<button name ="submit" type="submit" class="btn btn-default">Listar</button>
			<span><?php echo $error; ?></span>
		</form>
	</div>
	<?php include "template/default/footer.inc"; ?>
</body>
</html>

