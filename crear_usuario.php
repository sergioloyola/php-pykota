<?php
include('alta_de_usuario.php'); // Includes Login Script
include('session.php');
include "template/default/error_401.inc";
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
		<h2>Formulario de Alta</h2>
		<form action="" method="post">
			<div class="form-group">
				<label>Usuario :</label>
				<input class="form-control"  id="name" name="username" placeholder="username" type="text">
			</div>
			<div class="form-group">
				<label>Correo :</label>
				<input class="form-control"  id="correo" name="correo" placeholder="correo" type="text">
			</div>
			<?php
			$user= $_SESSION['login_user'];
			echo "<input type=\"hidden\" name=login value=\"$user\" />";
			?>
			<button name ="submit" type="submit" class="btn btn-default">Crear</button>
			<span><?php echo $error; ?></span>
		</form>
	</div>
<?php include "template/default/footer.inc"; ?>
</body>
</html>
