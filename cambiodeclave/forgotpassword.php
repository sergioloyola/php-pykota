<?php
//file name: settings.php
//Title:Build your own Forgot Password PHP Script
include('../config/funciones.php');
session_start( );
function connect()
{	
$host="localhost"; //host
$uname="root";  //username
$pass="dsiredes";      //password
$db= 'pykota';  //database name
 
$con = mysql_connect($host,$uname,$pass);
 
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db($db, $con);}
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
<p>Haga click en el siguiente link para cambiar su contraseña<a href="'.$uri.'/new_pykota/cambiodeclave/reset.php?token='.$token.'">Cambia contraseña</a></p>
 
</body>
</html>
';
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
$headers .= 'From: Admin<administrador@pykota.com.ar>' . "\r\n";
$headers .= 'Cc: sergio.loyola@unq.edu.ar' . "\r\n";


///Revisar session(KEY)
//die($_SESSION[ 'key' ]);
if($to != "" or  md5( $_POST[ 'code' ] ) == $_SESSION[ 'key' ]){  
if(mail($to,$subject,$message,$headers)){
//	echo "Se ha envio el link de cambio de contraseña a su correo id <b>".$to."</b>"; 
?>
	<script type="text/javascript">
        	alert("Se ha enviado el link de cambio de contraseña a su correo: <?php echo $to; ?>");
                location.href='../index.php?' + Math.random();
        </script>
<?php
historial("SyStem","El usuario a solicitado el cambio de contraseña",$to,$conexion);
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

