<!--Error401-->
<?php
if ($_SESSION['login_rol'] != '1') {
  echo "<html>";
  echo "<head>";
  echo "<title>Php-Pykota</title>";
  echo "<link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css\" integrity=\"sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u\" crossorigin=\"anonymous\">";
  echo "<link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css\" integrity=\"sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp\" crossorigin=\"anonymous\">";
  echo "<link href=\"style/style_bootstrap.css\" rel=\"stylesheet\" type=\"text/css\">";
  echo "</head>";
  echo "<body>";
  echo "<center><IMG SRC=\"images/401_error.png\" width=\"200\" height=\"200\"></center>";
  echo "<center><h1>Acceso denegado</h1></center>";
  echo "<center><h3>No tiene los privilegios necesarios para acceder a esta aplicación. Si considera que esto no es correcto, consulte el administrador.</h3></center>";
  echo "</body>";
  echo "</html>";
  exit();
}
?>
