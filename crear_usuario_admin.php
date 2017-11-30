<?php
include('crear_usuario_de_administracion.php');
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
	<h2>Usuario de administración</h2>
	<form name="adminuser" action="" method="post">
		<div class="form-group">
			<label>Usuario :</label>
			<input class="form-control" id="name" name="username" placeholder="username" type="text">
		</div>
		<div class="form-group">
			<label>Contraseña :</label>
			<input class="form-control" id="password" name="password" placeholder="contraseña" type="text">
		</div>
		<div class="form-group">
			<label>Correo :</label>
			<input class="form-control" id="correo" name="correo" placeholder="correo" type="text" value="" onfocusout="validarEmail()">
		</div>
		<div class="form-group">
			<label>Perfil :</label>
			<p id="demo"></p>
			<?php
			$link=mysql_connect("localhost","root","123456");
			mysql_select_db("pykota",$link);
			echo "<select class=\"form-control\" name=perfilname id=perfilname onclick=enabledisabletext()>";
			$sql="SELECT perfil FROM perfiles";
			$result=mysql_query($sql);
			$i=0;
			while ($row=mysql_fetch_row($result))
			{
				echo "<option value=".$row[$i].">".$row[$i]."</option>\n";
			}
			echo "</select>";
			mysql_close($link);
			?>
		</div>
		<script language="javascript">
function enabledisabletext()
{
	if(document.adminuser.perfilname.value=='administrador')
	{
		document.adminuser.groupname.disabled=true;
	}
       	if(document.adminuser.perfilname.value=='usuario')
       	{
       		document.adminuser.groupname.disabled=false;
       	}
}
function validateMail(idMail)
{
        //Creamos un objeto 
        object=document.getElementById(idMail);
        valueForm=object.value;
 
        // Patron para el correo
        var patron=/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/;
        if(valueForm.search(patron)==0)
        {
                //Mail correcto
                object.style.color="#000";
                return;
        }
        //Mail incorrecto
        object.style.color="#f00";
}

function validarEmail() {
    var x = document.getElementById("correo").value;
    expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if ( !expr.test(x) )
        alert("Error: La dirección de correo " + x + " es incorrecta.");
}

</script>
		<div class="form-group">
			<label>Grupo :</label>
			<?php
			$link=mysql_connect("localhost","root","123456");
			mysql_select_db("pykota",$link);
			echo"<select class=\"form-control\" name=groupname id=groupname>";
			$sql="SELECT groupname FROM groups";
			$result=mysql_query($sql);
			$i=0;
			while ($row=mysql_fetch_row($result))
			{
				echo "<option value=".$row[$i].">".$row[$i]."</option>\n";
			}
			echo "</select>";
			mysql_close($link);
			?>
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

