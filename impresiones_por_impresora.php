<?php
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
		<h2>Cantidad de Impresiones</h2>
		<form action="reporte_de_impresiones.php" method="post">
			<div class="form-group">
				<label>Impresora :</label>
				<?php
				$link=mysql_connect("localhost","root","dsiredes");
				mysql_select_db("pykota",$link);
				echo"<select class=\"form-control\" name=printername id=printername>";
				$sql="SELECT printername FROM printers";
				$result=mysql_query($sql);
				$i=0;
				echo "<option value=Todas>Todas</option>\n";
				while ($row=mysql_fetch_row($result))
				{
					echo "<option value=".$row[$i].">".$row[$i]."</option>\n";
				}
				echo "</select>";
			echo "</div>";
			?>
			<div class="form-group">
				<label for="mes">Mes :</label>
				<select class="form-control" name=mes id=name>
				<option value="anual" selected>Anual</option>
				<option value="enero" >Enero</option>
				<option value="febrero">Febrero</option>
				<option value="marzo">Marzo</option>
				<option value="abril" >Abril</option>
				<option value="mayo">Mayo</option>
				<option value="junio">Junio</option>
				<option value="julio">Julio</option>
				<option value="Agosto">Agosto</option>
				<option value="septiembre">Septiembre</option>
				<option value="octubre">Octubre</option>
				<option value="noviembre">Noviembre</option>
				<option value="diciembre">Diciembre</option>
				</select>
			</div>
			<div class="form-group">
				<label for="año">Año :</label>
				<select class="form-control" id="year" name="year">
				<script>
					var myDate = new Date();
					var year = myDate.getFullYear();
					for(var i = 2014; i < year+1; i++){
						document.write('<option value="'+i+'">'+i+'</option>');
  					}
  				</script>
				</select>
			</div>
			<button name ="submit" type="submit" class="btn btn-default">Listar</button>
			<span><?php echo $error; ?></span>
		</form>
	</div>
</div>
<?php include "template/default/footer.inc"; ?>
</body>
</html>

