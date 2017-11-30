<?php
//file reset.php
//title:Build your own Forgot Password PHP Script
include('../config/config.php');
include('../config/funciones.php');
session_start();
$token=$_POST['token'];
//die($token);
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
}
$error_password="";

		if (!validar_clave($pass, $error_password)){
    			?>
    			<script type="text/javascript">
            			alert("PASSWORD NO VÁLIDO: <?php echo $error_password; ?> ");
			        location.href='reset.php?'+"token=<?php echo $token; ?> ";
    			</script>
    			<?php
		}

if ($pass != "" && $pass == $checkpass && $error_password == "")
{
		$q="update login set password='".md5($pass)."' where email='".$email."'";
		$r=mysql_query($q);
		if($r)mysql_query("update tokens set used=1 where token='".$token."'");
		?>
        	<script type="text/javascript">
                	alert("Su contraseña se cambio con exito!!!");
                	location.href='../logout.php?' + Math.random();
        	</script>
		<?php
	if(!$r)echo "An error occurred";
}
