    <div class="container">

      <!-- Static navbar -->
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><b>Usuario:</b> <i><?php echo $login_session; ?></i></a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <!-- <li class="active"><a href="#">Inicio</a></li> -->
              <li class="active"><a href="./">Inicio <span class="sr-only">(current)</span></a></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Usuarios <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href='listar_usuarios.php'>Listar Usuarios</a></li>
                  <li><a href='usuarios_por_impresora.php'>Usuarios por Impresora</a></li>
                </ul>
              </li>

              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Impresoras <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href='listar_impresora.php'>Listar Impresoras</a></li>
                  <li><a href='asignar_cuota.php'>Asignar Cuota</a></li>
                </ul>
              </li>
              <!-- <li><a href="#">Reportes</a></li> -->
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Reportes <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href='impresiones_por_impresora.php'>Impresiones por Impresora</a></li>
                  <li><a href='impresiones_por_usuario.php'>Impresiones por Usuario</a></li>
                </ul>
              </li>
<?php
if($_SESSION['login_rol'] == '1'){


              echo "<li class=\"dropdown\">";
                echo "<a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-haspopup=\"true\" aria-expanded=\"false\">Configuraciones <span class=\"caret\"></span></a>";
                echo "<ul class=\"dropdown-menu\">";
                  echo "<li><a href='crear_usuario.php'>Crear Usuario</a></li>";
                  echo " <li><a href='modificar_usuario.php'>Modificar Usuario</a></li>";
                  echo "<li><a href='eliminar_usuario.php'>Eliminar Usuario</a></li>";
                  echo "<li><a href='crear_grupo.php'>Crear Grupo</a></li>";
                  echo "<li><a href='listar_usuarios_sistema.php'>Listar usuarios del sistema</a></li>";
                  echo "<li><a href='asignar_usuario_a_grupo.php'>Asignar Usuario a Grupo</a></li>";
                  echo "<li><a href='crear_usuario_admin.php'>Crear Usuarios Administradores</a></li>";
                  echo "<li><a href='agregar_impresora.php'>Agregar Impresora</a></li>";
                  echo "<li><a href='reiniciar_contadores.php'>Reinciar Contadores</a></li>";
                  echo "<li><a href='http://10.22.0.187:631/'>CUPS</a></li>";
                echo "</ul>";
              echo "</li>";
}
?>
            </ul>
            <ul class="nav navbar-nav navbar-right">
             <li><a href='cambiar_perfil.php'>Cambiar Perfil</a></li>
              <li><a href='logout.php'>Cerrar Sesion</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>
    </div> <!-- /container -->
   <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


