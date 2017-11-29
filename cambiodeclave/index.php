<?php
include('../config/config.php');
?>
<html>
<head>
<title>Php-Pykota</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<link href="../style/style_bootstrap.css" rel="stylesheet" type="text/css">
<?php
echo "<link href=\"$estilo_pass\" rel=stylesheet type=text/css>";
?>
</head>
<body>
<div class="container">
	<br>
	<center><img src="pykotasmall.png" alt="Web Pykota"></center>
	<h2><center>Restablecer contraseña<center></h2>
	<form action="forgotpassword.php">
		<div class="form-group">
			<label>Ingrese su dirección de correo:</label>
			<input class="form-control" id="email" name="email" type="text">
			<br>
			<img src="captcha.php" border="0" />
			<br>
			<br>
			<label>Ingresar el texto mostrado en la imagen:</label>
			<input class="form-control" id="code" type="text" name="code" width="25" />
	</div>
			<input type="submit"  class="btn btn-default" value="Cambiar la contraseña" />

	</form>
<div>
<body>
</html>
