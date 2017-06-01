<?php
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
<?php include "template/default/menu.inc"; ?>
<div class="container">
<h2>Seleccionar Usuario</h2>
<form action="borrar_usuario.php" method="post">
	<div class="form-group">
		<label>Usuario :</label>
		<?php
		$link=mysql_connect("localhost","root","dsiredes");
		mysql_select_db("pykota",$link);
		echo"<select class=\"form-control\" name=username id=username>";
		$sql="SELECT username FROM users";
		$result=mysql_query($sql);
		$i=0;
		while ($row=mysql_fetch_row($result))
		{
			echo "<option value=".$row[$i].">".$row[$i]."</option>\n";
		}
		echo "</select>";
		?>
	</div>
       <?php
                $user= $_SESSION['login_user'];
                echo "<input type=\"hidden\" name=login value=\"$user\" />";
       ?>

	<button name ="submit" type="submit" class="btn btn-default">Borrar</button>
	<span><?php echo $error; ?></span>
</form>
</div>
<?php include "template/default/footer.inc"; ?>
</body>
</html>

