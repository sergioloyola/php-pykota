<?php
include('login.php'); // Includes Login Script
include('config/config.php');
if(isset($_SESSION['login_user'])){
header("location: profile.php");
}
?>
<html>
<head>
<title>Php-Pykota</title>
        <?php
        echo "<link href=\"$estilo_login\" rel=stylesheet type=text/css>";
        echo "<link href=\"$estilo_oauth\" rel=stylesheet type=text/css>";
        ?>
</head>
<body class="contenedor">
	<form action="" method="post">
		<header>
			<h2><center>Sistema de Impresion</center></h2>
		</header>
		<div class="imgcontainer">
    			<img src="images/avatar.jpg" alt="Avatar" class="avatar">
  		</div>
		<div class="contenedor">
			<label><b>Usuario</b></label>
   			<center><input id="username" name="username" placeholder="Usuario" type="text" required="required"></center>
			<label><b>Contraseña</b></label>
			<center><input id="password" name="password" placeholder="Contraseña" type="password" required="required"></center>
			<center><button name="submit" type="submit">Ingresar</button><center>
    			<!-- <input type="checkbox" checked="checked"> Recordar -->
		</div>
		<div class="contenedor" style="background-color:#f1f1f1">
    			<!-- <button type="button" class="cancelbtn">Cancelar</button> -->
			<center> <a href="cambiodeclave">Olvido su contraseña?</a><center>
  		</div>
		<center>
		<button class="loginBtn loginBtn--facebook">
  			Login con Facebook
		</button>
		<button class="loginBtn loginBtn--google">
			Login con Google
		</button>
		</center>
	</form>
</body>
</html>


