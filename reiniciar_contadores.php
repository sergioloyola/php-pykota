<?php
include('reiniciar.php');
include('session.php');
include('config/config.php');
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
		<h2>Reiniciar Contadores</h2>
		<form action="" method="post"> 
			<div class="form-group">
			        <label>Tipo de Reinicio :</label>
				<select class="form-control" name=tipo id=tipo>
				<option value="usuario">Por usuario
  				<option value="grupos">Por Grupo
				</select>
			</div>
			<button name="elegir" type="submit" class="btn btn-default" >Elegir</button>
			<?php
			if(isset($_POST['tipo'])){
				$select1 = $_POST['tipo'];
			        switch ($select1) {
				        case 'usuario':
            					$tipo = "usuario";
            					break;
        				case 'grupos':
			   	                $tipo = "grupos";
					        break;
				        default:
					        $tipo = "usuario";
					        break;
    				}
			}

			?>
			<div class="form-group">
				<?php
				$user= $_SESSION['login_user'];
				$result_idgroup = mysql_query("SELECT idgroup from login where usuario='$user'",$conexion);
				$idgroup = mysql_fetch_row($result_idgroup);
				echo "<input type=\"hidden\" name=login value=\"$user\" />";
				if ($tipo == "usuario")
				{
					echo "<input type=\"hidden\" name=variable value=\"usuario\" />";
					echo "<label>Usuario :</label>";
					echo"<select class=\"form-control\" name=username id=username>";
					if ($user == "administrador")
					{
					$sql="SELECT username FROM users";
					$result=mysql_query($sql);
					$i=0;
				        echo "<option value=Todos>Todos</option>\n";
					while ($row=mysql_fetch_row($result))
					{
						echo "<option value=".$row[$i].">".$row[$i]."</option>\n";
					}
					echo "</select>";
					}else{
						$result_userid = mysql_query("select userid from groupsmembers where groupid='$idgroup[0]'", $conexion);
						$i=0;
						while ($userid = mysql_fetch_row($result_userid)){
							$result = mysql_query("SELECT username FROM users where id='$userid[0]'", $conexion); 
							while ($row=mysql_fetch_row($result))
        						{
						                echo "<option value=".$row[$i].">".$row[$i]."</option>\n";
        						}
						}
        					echo "</select>";
					}
				}
				if ($tipo == "grupos")
				{
					echo "<input type=\"hidden\" name=variable value=\"grupo\" />";
					echo "<label>Grupos :</label>";
					echo"<select class=\"form-control\" name=username id=username>";
					$sql="SELECT groupname FROM groups";
					$result=mysql_query($sql);
     					$i=0;
				        while ($row=mysql_fetch_row($result))
     					{
					         echo "<option value=".$row[$i].">".$row[$i]."</option>\n";
					}
         				echo "</select>";

				}
				?>
			</div>
		<button name="reiniciar_usuario" type="submit" class="btn btn-default" >Reiniciar</button>
		<button name="reiniciar_todo" type="submit" class="btn btn-default">Respaldar y Reiniciar</button>
	</form>
</div>
<?php include "template/default/footer.inc"; ?>
</body>
</html>
