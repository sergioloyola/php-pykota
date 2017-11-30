<?php
//file name: settings.php
//Title:Build your own Forgot Password PHP Script
include('../config/funciones.php');
include('../config/config.php');
session_start( );
function connect()
{	
$host="localhost"; //host
$uname="root";  //username
$pass="123456";      //password
$db= 'pykota';  //database name
 
$con = mysql_connect($host,$uname,$pass);
 
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db($db, $con);
}
//file name: forgotpassword.php
//Title:Build your own Forgot Password PHP Script
if(!isset($_GET['email'])){
	                  echo'<form action="forgotpassword.php">
	                      Enter Your Email Id:
	                         <input type="text" name="email" />
	                        <input type="submit" value="Restablecer mi contraseña" />
	                         </form>'; exit();
				       }
$email=$_GET['email'];
//include("settings.php");
connect();
$q="select email from login where email='".$email."'";
$r=mysql_query($q);
$n=mysql_num_rows($r);
if($n==0){echo "Email id is not registered";die();}
$token=getRandomString(10);
$q="insert into tokens (token,email) values ('".$token."','".$email."')";
mysql_query($q);

function getRandomString($length) 
{
    $validCharacters = "ABCDEFGHIJKLMNPQRSTUXYVWZ123456789";
    $validCharNumber = strlen($validCharacters);
    $result = "";
 
    for ($i = 0; $i < $length; $i++) {
        $index = mt_rand(0, $validCharNumber - 1);
        $result .= $validCharacters[$index];
    }
	return $result;
}

function mailresetlink($to,$token){
$subject = "Olvido su contraseña en Pykota Web";
$uri = 'http://'. $_SERVER['HTTP_HOST'] ;
$message = '
<html>
<head>
<title>Olvido su contraseña en Pykota Web</title>
</head>
<body>
<p>Se ha solicitado la renovación de contraseña,</p>
<p>Haga click en el siguiente link para cambiar su contraseña: <a href="'.$uri.'/php-pykota/cambiodeclave/reset.php?token='.$token.'">Cambia contraseña</a></p>
<p>Si usted no es el emisor de esta petición, por favor ignórela.</p>
<p>PHP-Pykota</p>
</body>
</html>
';

$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= 'From: Admin<administrador@pykota.com.ar>' . "\r\n";
//$headers .= 'Cc: sergio.loyola@unq.edu.ar' . "\r\n";


if($to != "" or  md5( $_POST[ 'code' ] ) == $_SESSION[ 'key' ]){  
if(mail($to,$subject,$message,$headers)){
?>
	<script type="text/javascript">
        	alert("Se ha enviado el link de cambio de contraseña a su correo: <?php echo $to; ?>");
                location.href='../index.php?' + Math.random();
        </script>
<?php
//historial("SyStem","El usuario a solicitado el cambio de contraseña",$to,$conexion);
//historial("SyStem","El usuario a solicitado el cambio de contraseña","perro",$conexion);
$admin="SyStem";
$descripcion="Solicito cambio de contraseña via mail";
//$user=$email;
$user_consult=mysql_query("select usuario from login where email='".$to."'");
$result = mysql_fetch_assoc($user_consult);
$user=$result['usuario'];
//$actu = "insert into historial (autor, accion, usuario) values (SyStem,Solicito cambio de contraseña via mail,Sergio)";
$actu= "insert into historial (autor,accion,usuario) values ('".$admin."','".$descripcion."','".$user."')";
$actualizar_historial=mysql_query($actu);
}
}else{
?>
        <script type="text/javascript">
                alert("Correo o captcha incorrecto");
                location.href='index.php?' + Math.random();
        </script>
<?php

}

}
 
if(isset($_GET['email']))mailresetlink($email,$token);

