<?php
//file reset.php
//title:Build your own Forgot Password PHP Script
include('../config/config.php');
include('../config/funciones.php');
//include('change_password.php');
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
//$pass=$_POST['password'];
//$checkpass=$_POST['checkpassword'];
//$email=$_SESSION['email'];
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
        <form action="change_password.php" method="post">
		<div class="form-group">
			<label>Ingrese su nueva contraseña:</label>
			<input class="form-control" id="password" name="password" type="password">
			<input type="hidden" name="token" value="<?php echo $token; ?>" />
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
?>
