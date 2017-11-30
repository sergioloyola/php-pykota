<?php
//file reset.php
//title:Build your own Forgot Password PHP Script
include('../config/config.php');
include('../config/funciones.php');
session_start();
$token=$_GET['token'];
include("settings.php");
connect();
if(!isset($_POST['password'])){
$q="select email from tokens where token='".$token."' and used=0";
$r=mysql_query($q);
while($row=mysql_fetch_array($r))
   {
$email=$row['email'];
   }
If ($email!=''){
          $_SESSION['email']=$email;
}
else die("Invalid link or Password already changed");}
$pass=$_POST['password'];
$checkpass=$_POST['checkpassword'];
$email=$_SESSION['email'];
if(!isset($pass)){
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
	<form method="post">
		<div class="form-group">
			<label>Ingrese su nueva contraseña:</label>
			<input class="form-control" id="password" name="password" type="password">
		</div>
		<div class="form-group">
                	<label>Repetir la nueva Contraseña :</label>
                	<input class="form-control" id="checkpassword" name="checkpassword" placeholder="chequear contraseña" type="password">
        	</div>

		<input type="submit" class="btn btn-default" value="Cambiar contraseña">
	</form>
</body>
</html>
<?php
}
$error_password="";
if (!validar_clave($pass, $error_password)){
    ?>
    <script type="text/javascript">
            alert("PASSWORD NO VÁLIDO: <?php echo $error_password; ?> ");
        location.href='reset.php?' + Math.random();
    </script>
    <?php
}

if ($pass != "" && $pass == $checkpass)
{
	if(isset($_POST['password'])&&isset($_SESSION['email']))
	{
		$q="update login set password='".md5($pass)."' where email='".$email."'";
		$r=mysql_query($q);
		if($r)mysql_query("update tokens set used=1 where token='".$token."'");
		?>
        	<script type="text/javascript">
                	alert("Su contraseña se cambio con exito!!!");
                	location.href='../index.php?' + Math.random();
        	</script>
		<?php

	if(!$r)echo "An error occurred";
	}
}
